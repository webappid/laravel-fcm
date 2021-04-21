<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Requests;

/**
 * @author: 
 * Date: 04:25:32
 * Time: 2021/04/18
 * Class FcmSubscribeRepositoryRequest
 * @package WebAppId\Fcm\Repositories\Requests
 */
class FcmSubscribeRepositoryRequest
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
