<?php


namespace WebAppId\Fcm\Repositories;


use Illuminate\Database\QueryException;
use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Repositories\Contracts\FcmSubscribeRepositoryContract;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmSubscribeRepository implements FcmSubscribeRepositoryContract
{
    
    /**
     * @param FcmSubscribeParam $fcmSubscribeParam
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe|null
     */
    public function store(FcmSubscribeParam $fcmSubscribeParam, FcmSubscribe $fcmSubscribe): ?FcmSubscribe
    {
        try {
            $fcmSubscribe->owner_id = $fcmSubscribeParam->getOwnerId();
            $fcmSubscribe->fcm_project_id = $fcmSubscribeParam->getFcmProjectId();
            $fcmSubscribe->token = $fcmSubscribeParam->getToken();
            $fcmSubscribe->active = $fcmSubscribeParam->getActive();
            $fcmSubscribe->agent = $fcmSubscribeParam->getAgent();
            $fcmSubscribe->user_id = $fcmSubscribeParam->getUserId();
            $fcmSubscribe->save();
            return $fcmSubscribe;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
}