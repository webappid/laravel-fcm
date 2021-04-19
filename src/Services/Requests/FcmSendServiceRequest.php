<?php
/**
 * Created by PhpStorm.
 */

namespace WebAppId\Fcm\Services\Requests;


use WebAppId\Fcm\Models\Notify;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 18/04/2021
 * Time: 11.34
 * Class FcmSendRequest
 * @package WebAppId\Fcm\Services\Requests
 */
class FcmSendServiceRequest
{
    /**
     * @var array
     */
    public $datas;
    /**
     * @var Notify
     */
    public $notification;
    /**
     * @var string
     */
    public $priority = "high";
}