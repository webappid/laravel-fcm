<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Responses;

use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Fcm\Models\FcmSubscribe;

/**
 * @author: 
 * Date: 04:25:53
 * Time: 2021/04/18
 * Class FcmSubscribeServiceResponse
 * @package WebAppId\Fcm\Services\Responses
 */
class FcmSubscribeServiceResponse extends AbstractResponse
{
    /**
     * @var FcmSubscribe
     */
    public $fcmSubscribe;
}
