<?php
/**
 * Author: galih
 * Date: 2019-05-17
 * Time: 18:26
 */

namespace WebAppId\Fcm\Tests\Feature\Services;

use WebAppId\Fcm\Services\FcmSubscribeService;
use WebAppId\Fcm\Tests\TestCase;
use WebAppId\Fcm\Tests\Unit\Repositories\FcmProjectRepositoryTest;
use WebAppId\Fcm\Tests\Unit\Repositories\FcmSubscribeRepositoryTest;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeServiceTest
 * @package Tests\Feature\Services
 */
class FcmSubscribeServiceTest extends TestCase
{
    
    /**
     * @var FcmSubscribeRepositoryTest
     */
    private $fcmSubscribeRepositoryTest;
    
    /**
     * @var FcmSubscribeService
     */
    private $fcmSubscribeService;
    
    /**
     * @var FcmProjectRepositoryTest
     */
    private $fcmProjectRepositoryTest;
    
    /**
     * @return FcmSubscribeService
     */
    private function fcmSubcribeService(): FcmSubscribeService
    {
        if ($this->fcmSubscribeService == null) {
            $this->fcmSubscribeService = $this->getContainer()->make(FcmSubscribeService::class);
        }
        
        return $this->fcmSubscribeService;
    }
    
    /**
     * @return FcmProjectRepositoryTest
     */
    private function fcmProjectRepositoryTest(): FcmProjectRepositoryTest
    {
        if ($this->fcmProjectRepositoryTest == null) {
            $this->fcmProjectRepositoryTest = $this->getContainer()->make(FcmProjectRepositoryTest::class);
        }
        
        return $this->fcmProjectRepositoryTest;
    }
    
    /**
     * @return FcmSubscribeRepositoryTest
     */
    private function fcmSubscribeRepositoryTest(): FcmSubscribeRepositoryTest
    {
        if ($this->fcmSubscribeRepositoryTest == null) {
            $this->fcmSubscribeRepositoryTest = $this->getContainer()->make(FcmSubscribeRepositoryTest::class);
        }
        
        return $this->fcmSubscribeRepositoryTest;
    }
    
    public function testStore()
    {
        $project = $this->getContainer()->call([$this->fcmProjectRepositoryTest(), 'testStore']);
        $dummy = $this->fcmSubscribeRepositoryTest()->dummy($project->id);
        $result = $this->getContainer()->call([$this->fcmSubcribeService(), 'store'], ['fcmSubscribeParam' => $dummy]);
        self::assertTrue($result->isStatus());
    }
}
