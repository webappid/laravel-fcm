<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 12:57
 */

namespace WebAppId\Fcm\Services;


use WebAppId\DDD\Services\BaseService;
use WebAppId\Fcm\Repositories\FcmRepository;
use WebAppId\Fcm\Responses\FcmResponse;
use WebAppId\Fcm\Services\Contracts\FcmServiceContract;
use WebAppId\Fcm\Services\Params\FcmSendParam;

class FcmService extends BaseService implements FcmServiceContract
{
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param array $registrationIds
     * @param FcmRepository $fcmRepository
     * @param FcmResponse $fcmResponse
     * @param array $data
     * @return void
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmRepository $fcmRepository,
                              FcmResponse $fcmResponse,
                              array $data = []): void
    {
        $this->getContainer()->call([$fcmRepository, 'sendBlast'],
            [
                'fcmSendParam' => $fcmSendParam,
                'registrationIds' => $registrationIds,
                'data' => $data
            ]);
        
    }
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @param FcmResponse $fcmResponse
     * @param array $data
     * @return void
     */
    public function sendToTopic(FcmSendParam $fcmSendParam, string $topic, FcmRepository $fcmRepository, FcmResponse $fcmResponse, array $data = []): void
    {
        $this->getContainer()->call([$fcmRepository, 'sendToTopic'], ['fcmSendParam' => $fcmSendParam, 'topic' => $topic]);
    }
    
    /**
     * @param string $token
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @return void
     */
    public function subscribeTopic(string $token, string $topic, FcmRepository $fcmRepository): void
    {
        $this->getContainer()->call([$fcmRepository, 'subscribeTopic'], ['token' => $token, 'topic' => $topic]);
    }
}