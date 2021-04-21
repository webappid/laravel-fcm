<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Responses;

use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Fcm\Models\FcmProject;

/**
 * @author: 
 * Date: 02:03:32
 * Time: 2021/04/18
 * Class FcmProjectServiceResponse
 * @package WebAppId\Fcm\Services\Responses
 */
class FcmProjectServiceResponse extends AbstractResponse
{
    /**
     * @var FcmProject
     */
    public $fcmProject;
}
