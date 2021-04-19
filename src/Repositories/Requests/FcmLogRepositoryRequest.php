<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Requests;

/**
 * @author: 
 * Date: 05:49:20
 * Time: 2021/04/19
 * Class FcmLogRepositoryRequest
 * @package WebAppId\Fcm\Repositories\Requests
 */
class FcmLogRepositoryRequest
{
    
    /**
     * @var int
     */
    public $fcm_subscribe_id;
                
        
    /**
     * @var string
     */
    public $request;
                
        
    /**
     * @var string
     */
    public $response;
                
        
    /**
     * @var int
     */
    public $user_id;
                
}
