<?php
/**
 * Author: galih
 * Date: 2019-05-17
 * Time: 20:40
 */

namespace WebAppId\Fcm\Repositories\Contracts;


use WebAppId\DDD\Tools\PopoTools;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Services\Params\FcmSendParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmRepositoryContract
{
    /**
     * @param FcmSendParam $fcmSendParam
     * @param array $registrationIds
     * @param FcmProject $fcmProject
     * @return object
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmProject $fcmProject): object ;
}