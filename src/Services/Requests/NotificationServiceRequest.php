<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Requests;

/**
 * @author: 
 * Date: 08:09:17
 * Time: 2021/04/20
 * Class NotificationServiceRequest
 * @package WebAppId\Fcm\Services\Requests
 */
class NotificationServiceRequest
{
    
    /**
     * @var string
     */
    public $code;
                
        
    /**
     * @var int
     */
    public $user_id;
                
        
    /**
     * @var int
     */
    public $receiver_id;
                
        
    /**
     * @var string
     */
    public $title;
                
        
    /**
     * @var string
     */
    public $body;
                
        
    /**
     * @var string
     */
    public $action;
                
}
