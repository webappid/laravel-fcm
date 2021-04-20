<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 13:10
 */

namespace WebAppId\Fcm\Tests\Feature\Services;

use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Services\FcmService;
use WebAppId\Fcm\Tests\TestCase;
use WebAppId\Fcm\Tests\Unit\Repositories\FcmRepositoryTest;

class FcmServiceTest extends TestCase
{
    /**
     * @var FcmService
     */
    private $fcmService;
    
    /**
     * @var FcmProjectRepository
     */
    private $fcmProjectRepository;
    
    /**
     * @var FcmRepositoryTest
     */
    private $fcmRepositoryTest;
    
    /**
     * FcmServiceTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->fcmService = $this->getContainer()->make(FcmService::class);
        $this->fcmProjectRepository = $this->getContainer()->make(FcmProjectRepository::class);
        $this->fcmRepositoryTest = $this->getContainer()->make(FcmRepositoryTest::class);
        parent::__construct($name, $data, $dataName);
    }
    
    /**
     * @return void
     */
    public function testSendBlast(): void
    {
        $this->fcmRepositoryTest->dummyProjectKey();
        $registration_ids = $this->fcmRepositoryTest->dummyBlastClient();
        $dummy = $this->fcmRepositoryTest->dummy();
        $this->getContainer()->call([$this->fcmService, 'sendBlast'], ['fcmSendParam' => $dummy, 'registrationIds' => $registration_ids]);
        self::assertTrue(true);
    }
    /**
     * @return void
     */
    public function testSubscribeTopic(): void
    {
        $this->fcmRepositoryTest->dummyProjectKey();
        $topic = 'webappid-laravel-fcm';
        $registration_ids = $this->fcmRepositoryTest->dummyBlastClient();
        $this->getContainer()->call([$this->fcmService,'subscribeTopic'],['token' => $registration_ids[0], 'topic' => $topic]);
        self::assertTrue(true);
    }
    /**
     * @return void
     */
    public function testSendTopic():void
    {
        $this->fcmRepositoryTest->dummyProjectKey();
        $topic = 'webappid-laravel-fcm';
        $dummy = $this->fcmRepositoryTest->dummy();
        $this->getContainer()->call([$this->fcmService, 'sendToTopic'], ['fcmSendParam' => $dummy, 'topic' => $topic]);
        self::assertTrue(true);
    }
}
