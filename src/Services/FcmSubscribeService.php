<?php
/**
 * Author: galih
 * Date: 2019-05-17
 * Time: 18:23
 */

namespace WebAppId\Fcm\Services;


use WebAppId\DDD\Services\BaseService;
use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Responses\FcmSubscribeResponse;
use WebAppId\Fcm\Services\Contracts\FcmSubscribeServiceContract;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeService
 * @package WebAppId\Fcm\Services
 */
class FcmSubscribeService extends BaseService implements FcmSubscribeServiceContract
{
    
    /**
     * @param FcmSubscribeParam $fcmSubscribeParam
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeResponse $fcmSubscribeResponse
     * @return FcmSubscribeResponse
     */
    public function store(FcmSubscribeParam $fcmSubscribeParam, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeResponse $fcmSubscribeResponse): FcmSubscribeResponse
    {
        $result = $this->getContainer()->call([$fcmSubscribeRepository, 'store'], ['fcmSubscribeParam' => $fcmSubscribeParam]);
        if ($result != null) {
            $fcmSubscribeResponse->setStatus(true);
            $fcmSubscribeResponse->setMessage('Save Subscribe Success');
            $fcmSubscribeResponse->setFcmSubscribe($result);
        } else {
            $fcmSubscribeResponse->setStatus(false);
            $fcmSubscribeResponse->setMessage('Save Subscribe Failed');
        }
        
        return $fcmSubscribeResponse;
    }
}