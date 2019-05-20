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
     * @return FcmResponse
     */
    public function sendBlast(FcmSendParam $fcmSendParam, array $registrationIds, FcmRepository $fcmRepository, FcmResponse $fcmResponse): FcmResponse
    {
        $result = $this->getContainer()->call([$fcmRepository,'sendBlast'],['fcmSendParam' => $fcmSendParam, 'registrationIds' => $registrationIds]);
        
        if($result->success==1){
            $fcmResponse->setStatus(true);
            $fcmResponse->setMessage('Send data success');
            $fcmResponse->setResult($result);
        }else{
            $fcmResponse->setStatus(false);
            $fcmResponse->setMessage('Send data failed');
        }
        
        return $fcmResponse;
    }
}