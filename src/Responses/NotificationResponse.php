<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Responses;

/**
 * @author: 
 * Date: 08:08:46
 * Time: 2021/04/20
 * Class NotificationRepositoryRequest
 * @package WebAppId\Fcm\Responses
 */
class NotificationResponse
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
