<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 09:40
 */

namespace WebAppId\Fcm\Tests\Unit\Repositories;

use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Repositories\FcmRepository;
use WebAppId\Fcm\Services\Requests\FcmSendServiceRequest;
use WebAppId\Fcm\Tests\TestCase;

class FcmRepositoryTest extends TestCase
{
    /**
     * @var FcmProjectRepository
     */
    private $fcmProjectRepository;
    
    /**
     * @var FcmRepository
     */
    private $fcmRepository;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->fcmRepository = $this->getContainer()->make(FcmRepository::class);
        $this->fcmProjectRepository = $this->getContainer()->make(FcmProjectRepository::class);
        parent::__construct($name, $data, $dataName);
    }
    
    public function dummy(): FcmSendServiceRequest
    {
        $fcmSendServiceRequest = new FcmSendServiceRequest();
        $fcmSendServiceRequest->title = $this->getFaker()->title;
        $fcmSendServiceRequest->body = $this->getFaker()->text(200);
        $fcmSendServiceRequest->url_action = $this->getFaker()->url;
        $fcmSendServiceRequest->icon = $this->getFaker()->name;
        return $fcmSendServiceRequest;
    }
    
    public function dummyClient(): void
    {
        $result = $this->dummyProjectKey();
        $clientToken = '';
        $fcmSubscribeParam = new FcmSubscribeParam();
        $fcmSubscribeParam->setToken($clientToken);
        $fcmSubscribeParam->setUserId(1);
        $fcmSubscribeParam->setOwnerId(1);
        $fcmSubscribeParam->setFcmProjectId($result->id);
        $fcmSubscribeParam->setActive('true');
        $fcmSubscribeParam->setAgent($this->getFaker()->userAgent);
    }
    
    public function dummyProjectKey(): FcmProject
    {
        $serverKey = 'AAAAMcmJ_zQ:APA91bFm3bxWc-mw8jDqm1f8ot7gvyS8vDNSJWUeLQd4CZMGB3Ta1G8O_EwCJFsaGMFEiWXYoCxUPUh0AVBoTXDdg_hUSnarrCwCM9eMBsE2gSYp84Lc2FWCGuwb2Eqiu89icMVkN-Yf';
        $projectName = 'gost-protocol';
        $projectParam = new ProjectParam();
        $projectParam->setName($projectName);
        $projectParam->setUserId('1');
        $projectParam->setServerKey($serverKey);
        return $this->getContainer()->call([$this->fcmProjectRepository, 'store'], ['projectParam' => $projectParam]);
    }
    
    public function dummyBlastClient(): array
    {
        $registration_ids = [];
        $registration_ids[] = 'fnQfZDIzFeI:APA91bGoImq8QxIMkMJeAVin8qfArYuwPdjC0TAUWh7q1F_dvcAho7jDYBDONQrmXGFQrueLYB8zq2OKFMI_u5nxEZjNNRyViON_MbAKGeyvZqN4FJCKtQfWKE3xw5e_LJrNehPslUJ8';
        return $registration_ids;
    }
    
    /**
     * @return void
     */
    public function testSendBlast(): void
    {
        $this->dummyProjectKey();
        $registration_ids = $this->dummyBlastClient();
        $dummy = $this->dummy();
        $results = $this->getContainer()->call([$this->fcmRepository, 'sendBlast'],
            [
                'fcmSendParam' => $dummy,
                'registrationIds' => $registration_ids,
                'data' => ["key" => "value"]
            ]);
        
        foreach ($results as $result) {
            self::assertEquals(1, $result->success);
        }
    }
    
    public function testSendTopic(): void
    {
        $this->dummyProjectKey();
        $dummy = $this->dummy();
        $results = $this->getContainer()->call([$this->fcmRepository, 'sendToTopic'],
            [
                'fcmSendParam' => $dummy,
                'topic' => 'webappid-laravel-fcm',
                'data' => ['key' => 'value']
            ]);
        
        foreach ($results as $result) {
            self::assertGreaterThanOrEqual(1, $result->message_id);
        }
    }
    
    public function testSubscribeTopic(): void
    {
        $this->dummyProjectKey();
        $results = $this->getContainer()->call([$this->fcmRepository, 'subscribeTopic'],
            [
                'token' => 'webappid-laravel-fcm',
                'topic' => $this->getFaker()->text
            ]);
        
        foreach ($results as $result) {
            self::assertGreaterThanOrEqual(200, $result);
        }
    }
}
