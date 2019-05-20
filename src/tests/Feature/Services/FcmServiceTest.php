<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 13:10
 */

namespace Tests\Feature\Services;

use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Services\FcmService;
use WebAppId\Fcm\Services\Params\FcmSendParam;
use WebAppId\Fcm\Services\Params\ProjectParam;
use WebAppId\Fcm\Tests\TestCase;

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
     * FcmServiceTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->fcmService = $this->getContainer()->make(FcmService::class);
        $this->fcmProjectRepository = $this->getContainer()->make(FcmProjectRepository::class);
        parent::__construct($name, $data, $dataName);
    }
    
    public function dummyProjectKey(): FcmProject
    {
        $serverKey = 'AAAAQh064PI:APA91bGCEvNkdccRak2VwJtJgj0FphXil6i5oW_6cs8JZqTs1wKaa5IEqVca1OJ5YoN7p2RzZfWpaUat2S70rsV9Up6eVTe6xTpHYlvOTmU9ch8kBbhYvoYL5932yoB7vqQwaE_NFov3';
        $projectName = 'aira-web';
        $projectParam = new ProjectParam();
        $projectParam->setName($projectName);
        $projectParam->setUserId('1');
        $projectParam->setServerKey($serverKey);
        return $this->getContainer()->call([$this->fcmProjectRepository, 'store'], ['projectParam' => $projectParam]);
    }
    
    public function dummyBlastClient(): array
    {
        $registration_ids = [];
        $registration_ids[] = 'fcMZCCS6kKU:APA91bE5ozFiGKm7zbMRBc4UqZ7mmNnQ8AANuXE3VN7slkRdXD6lqSXCGx1TBRrxqRplhJE1IGUILKBuAs5bqamzLdlfrwFSpCYHOAz_9JGGeVsxLRtyzxsHEDKE7AkNS62Kl2ZvPTV8';
        return $registration_ids;
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
    
    /**
     * @return void
     */
    public function testSendBlast(): void
    {
        $this->dummyProjectKey();
        $registration_ids = $this->dummyBlastClient();
        $dummy = $this->dummy();
        $result = $this->getContainer()->call([$this->fcmService, 'sendBlast'], ['fcmSendParam' => $dummy, 'registrationIds' => $registration_ids]);
        self::assertTrue($result->isStatus());
    }
}
