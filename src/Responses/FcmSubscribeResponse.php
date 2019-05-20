<?php


namespace WebAppId\Fcm\Responses;

use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Fcm\Models\FcmSubscribe;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeResponse
 * @package WebAppId\Fcm\Responses
 */
class FcmSubscribeResponse extends AbstractResponse
{
    /**
     * @var FcmSubscribe
     */
    private $fcmSubscribe;
    
    /**
     * @return FcmSubscribe
     */
    public function getFcmSubscribe(): FcmSubscribe
    {
        return $this->fcmSubscribe;
    }
    
    /**
     * @param FcmSubscribe $fcmSubscribe
     */
    public function setFcmSubscribe(FcmSubscribe $fcmSubscribe): void
    {
        $this->fcmSubscribe = $fcmSubscribe;
    }
}