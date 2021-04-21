<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 02:03:35
 * Time: 2021/04/18
 * Class FcmProjectServiceResponseList
 * @package WebAppId\Fcm\Services\Responses
 */
class FcmProjectServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $fcmProjectList;
}
