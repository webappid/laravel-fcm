<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 09:22
 */

namespace WebAppId\Fcm\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Collection;
use WebAppId\DDD\Tools\PopoTools;
use WebAppId\Fcm\Models\Fcm;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\Contracts\FcmRepositoryContract;
use WebAppId\Fcm\Repositories\Requests\FcmRepositoryRequest;
use WebAppId\Fcm\Services\Params\FcmSendParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmRepository implements FcmRepositoryContract
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
                            Collection $serverKeys): string
    {
        $payloads = (array)$fcmRepositoryRequest;

        $headers = [
            'Authorization' => ' key=' . $serverKey,
            'Content-Type' => ' application/json'
        ];
        $client = new Client(
            [
                'headers' => $headers
            ]);

        $result = $client->post($url, [RequestOptions::JSON => $payloads]);

        return $result->getBody()->getContents();
    }
}
