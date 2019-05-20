<?php


namespace WebAppId\Fcm\Repositories\Contracts;


use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmSubscribeRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmSubscribeRepositoryContract
{
    /**
     * @param FcmSubscribeParam $fcmSubscribeParam
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe|null
     */
    public function store(FcmSubscribeParam $fcmSubscribeParam, FcmSubscribe $fcmSubscribe): ?FcmSubscribe;
}