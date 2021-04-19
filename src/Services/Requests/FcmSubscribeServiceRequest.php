<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Requests;

/**
 * @author: 
 * Date: 04:25:50
 * Time: 2021/04/18
 * Class FcmSubscribeServiceRequest
 * @package WebAppId\Fcm\Services\Requests
 */
class FcmSubscribeServiceRequest
{
    
    /**
     * @var int
     */
    public $fcm_project_id;
                
        
    /**
     * @var string
     */
    public $token;
                
        
    /**
     * @var string
     */
    public $active;
                
        
    /**
     * @var string
     */
    public $agent;
                
        
    /**
     * @var int
     */
    public $user_id;
                
        
    /**
     * @var int
     */
    public $creator_id;
                
        
    /**
     * @var int
     */
    public $owner_id;
                
}
