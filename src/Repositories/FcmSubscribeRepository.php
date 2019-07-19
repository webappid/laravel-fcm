<?php


namespace WebAppId\Fcm\Repositories;


use Exception;
use Illuminate\Database\QueryException;
use WebAppId\DDD\Tools\Lazy;
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
     * @throws Exception
     */
    public function store(FcmSubscribeParam $fcmSubscribeParam, FcmSubscribe $fcmSubscribe): ?FcmSubscribe
    {
        try {
            $fcmSubscribe = Lazy::copy($fcmSubscribeParam, $fcmSubscribe);
            $fcmSubscribe->save();
            return $fcmSubscribe;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
}