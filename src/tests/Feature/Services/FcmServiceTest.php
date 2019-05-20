<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 13:10
 */

namespace WebAppId\Fcm\Tests\Feature\Services;

use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Services\FcmService;
use WebAppId\Fcm\Services\Params\FcmSendParam;
use WebAppId\Fcm\Services\Params\ProjectParam;
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
        $result = $this->getContainer()->call([$this->fcmService, 'sendBlast'], ['fcmSendParam' => $dummy, 'registrationIds' => $registration_ids]);
        self::assertTrue($result->isStatus());
    }
}
