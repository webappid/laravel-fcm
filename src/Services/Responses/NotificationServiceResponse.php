<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Responses;

use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Fcm\Models\Notification;

/**
 * @author: 
 * Date: 08:09:22
 * Time: 2021/04/20
 * Class NotificationServiceResponse
 * @package WebAppId\Fcm\Services\Responses
 */
class NotificationServiceResponse extends AbstractResponse
{
    /**
     * @var Notification
     */
    public $notification;
}
