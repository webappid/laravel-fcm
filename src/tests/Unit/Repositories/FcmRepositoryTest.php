<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 09:40
 */

namespace Tests\Unit\Repositories;

use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Repositories\FcmRepository;
use WebAppId\Fcm\Services\Params\FcmSendParam;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;
use WebAppId\Fcm\Services\Params\ProjectParam;
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
    
    public function dummy(): FcmSendParam
    {
        $fcmSendParam = new FcmSendParam();
        $fcmSendParam->setTitle($this->getFaker()->title);
        $fcmSendParam->setBody($this->getFaker()->text(200));
        $fcmSendParam->setUrlAction($this->getFaker()->url);
        $fcmSendParam->setIcon($this->getFaker()->imageUrl());
        return $fcmSendParam;
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
        $serverKey = '';
        $projectName = '';
        $projectParam = new ProjectParam();
        $projectParam->setName($projectName);
        $projectParam->setUserId('1');
        $projectParam->setServerKey($serverKey);
        return $this->getContainer()->call([$this->fcmProjectRepository, 'store'], ['projectParam' => $projectParam]);
    }
    
    public function dummyBlastClient(): array
    {
        $registration_ids = [];
        $registration_ids[] = '';
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
        $result = $this->getContainer()->call([$this->fcmRepository, 'sendBlast'],
            [
                'fcmSendParam' => $dummy,
                'registrationIds' => $registration_ids
            ]);
        
        self::assertEquals(1, $result->success);
    }
}
