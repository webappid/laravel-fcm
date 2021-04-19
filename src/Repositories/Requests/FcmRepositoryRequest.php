<?php
/**
 * Created by PhpStorm.
 */

namespace WebAppId\Fcm\Repositories\Requests;


use WebAppId\Fcm\Models\Notify;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 19/04/2021
 * Time: 03.35
 * Class FcmRepositoryRequest
 * @package WebAppId\Fcm\Repositories\Requests
 */
class FcmRepositoryRequest
{
    /**
     * @var array
     */
    public $registration_ids;
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
