<?php


namespace WebAppId\Fcm\Services\Contracts;

use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Responses\FcmSubscribeResponse;
use WebAppId\Fcm\Services\Params\FcmSubscribeParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmSubscribeServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface FcmSubscribeServiceContract
{
    /**
     * @param FcmSubscribeParam $fcmSubscribeParam
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeResponse $fcmSubscribeResponse
     * @return FcmSubscribeResponse
     */
    public function store(FcmSubscribeParam $fcmSubscribeParam, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeResponse $fcmSubscribeResponse): FcmSubscribeResponse;
}