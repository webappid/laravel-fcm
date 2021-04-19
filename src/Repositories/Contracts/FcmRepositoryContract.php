<?php
/**
 * Author: galih
 * Date: 2019-05-17
 * Time: 20:40
 */

namespace WebAppId\Fcm\Repositories\Contracts;


use Illuminate\Database\Eloquent\Collection;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\Requests\FcmRepositoryRequest;
use WebAppId\Fcm\Services\Params\FcmSendParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmRepositoryContract
{
    /**
     * @param string $serverKey
     * @param string $url
     * @param FcmRepositoryRequest $fcmRepositoryRequest
     * @param Collection $serverKeys
     * @return string
     */
    public function sendFcm(string $serverKey,
                            string $url,
                            FcmRepositoryRequest $fcmRepositoryRequest,
                            Collection $serverKeys): string;
}
