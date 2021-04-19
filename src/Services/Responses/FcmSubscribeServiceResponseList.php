<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponseList;

/**
 * @author: 
 * Date: 04:25:57
 * Time: 2021/04/18
 * Class FcmSubscribeServiceResponseList
 * @package WebAppId\Fcm\Services\Responses
 */
class FcmSubscribeServiceResponseList extends AbstractResponseList
{
    /**
     * @var LengthAwarePaginator
     */
    public $fcmSubscribeList;
}
