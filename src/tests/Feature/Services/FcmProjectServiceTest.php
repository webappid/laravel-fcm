<?php

namespace WebAppId\Fcm\Tests\Feature\Services;

use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\Fcm\Tests\TestCase;
use WebAppId\Fcm\Tests\Unit\Repositories\FcmProjectRepositoryTest;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProjectServiceTest
 * @package Tests\Feature\Services
 */
class FcmProjectServiceTest extends TestCase
{
    
    /**
     * @var FcmProjectRepositoryTest
     */
    private $fcmProjectRepositoryTest;
    
    /**
     * @var FcmProjectService
     */
    private $fcmProjectService;
    
    /**
     * @return FcmProjectService
     */
    private function fcmProjectService(): FcmProjectService
    {
        if ($this->fcmProjectService == null) {
            $this->fcmProjectService = $this->getContainer()->make(FcmProjectService::class);
        }
        
        return $this->fcmProjectService;
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
    
    public function testStore(): void
    {
        $dummy = $this->fcmProjectRepositoryTest()->dummy();
        $result = $this->getContainer()->call([$this->fcmProjectService(),'store'],['projectParam'=>$dummy]);
        self::assertTrue($result->isStatus());
    }
}
