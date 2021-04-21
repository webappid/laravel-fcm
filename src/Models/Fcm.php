<?php
/**
 * Created by PhpStorm.
 */

namespace WebAppId\Fcm\Models;


/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 19/04/2021
 * Time: 14.39
 * Class Fcm
 * @package WebAppId\Fcm\Models
 */
class Fcm
{
    public const URL = 'https://fcm.googleapis.com/fcm/send';
   
    public const URL_SUBSCRIBE_TOPIC = 'https://iid.googleapis.com/iid/v1/%s/rel/topics/%s';
    
}