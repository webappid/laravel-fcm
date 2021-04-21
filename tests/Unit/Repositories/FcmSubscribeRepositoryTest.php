<?php

namespace WebAppId\Fcm\Tests\Unit\Repositories;

use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;
use WebAppId\Fcm\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeRepositoryTest
 * @package WebAppId\Fcm\Tests\Unit\Repositories
 */
class FcmSubscribeRepositoryTest extends TestCase
{
    
    /**
     * @var FcmSubscribeRepository
     */
    private $fcmSubscribeRepository;
    
    /**
     * @var FcmProjectRepositoryTest
     */
    private $fcmProjectRepositoryTest;
    
    /**
     * @return FcmProjectRepositoryTest
     */
    public function fcmProjectRepositoryTest(): FcmProjectRepositoryTest
    {
        if ($this->fcmProjectRepositoryTest == null) {
            $this->fcmProjectRepositoryTest = $this->getContainer()->make(FcmProjectRepositoryTest::class);
        }
        
        return $this->fcmProjectRepositoryTest;
    }
    
    /**
     * @return FcmSubscribeRepository
     */
    protected function fcmSubscribeRepository(): FcmSubscribeRepository
    {
        if ($this->fcmSubscribeRepository == null) {
            $this->fcmSubscribeRepository = $this->getContainer()->make(FcmSubscribeRepository::class);
        }
        return $this->fcmSubscribeRepository;
    }
    
    public function dummy(int $projectId): FcmSubscribeParam
    {
        $fcmSubscribeParam = new FcmSubscribeParam();
        $fcmSubscribeParam->setUserId($this->getFaker()->randomNumber());
        $fcmSubscribeParam->setOwnerId($this->getFaker()->randomNumber());
        $fcmSubscribeParam->setActive('yes');
        $fcmSubscribeParam->setAgent($this->getFaker()->userAgent);
        $fcmSubscribeParam->setFcmProjectId($projectId);
        $fcmSubscribeParam->setToken($this->getFaker()->uuid);
        return $fcmSubscribeParam;
    }
    
    public function testStore()
    {
        $fcmProject = $this->fcmProjectRepositoryTest()->testStore();
        $dummySubscribe = $this->dummy($fcmProject->id);
        $result = $this->getContainer()->call([$this->fcmSubscribeRepository(), 'store'], ['fcmSubscribeParam' => $dummySubscribe]);
        self::assertNotEquals(null, $result);
        self::assertNotEquals(null, $result->id);
    }
}
