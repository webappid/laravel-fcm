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
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\Contracts\FcmRepositoryContract;
use WebAppId\Fcm\Services\Params\FcmSendParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmRepository implements FcmRepositoryContract
{
    
    private const URL = 'https://fcm.googleapis.com/fcm/send';
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param array $registrationIds
     * @param FcmProject $fcmProject
     * @return object
     * @throws \ReflectionException
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmProject $fcmProject): object
    {
        $serverKeys = $this->getAllServerKey($fcmProject);
        
        $pt = new PopoTools();
        
        $message = $pt->serialize($fcmSendParam);
        $fcmFields = [];
        $fcmFields['priority'] = 'high';
        $fcmFields['notification'] = $message;
        $fcmFields['registration_ids'] = $registrationIds;
        
        
        foreach ($serverKeys as $serverKey) {
            $headers = [
                'Authorization' => ' key=' . $serverKey->server_key,
                'Content-Type' => ' application/json',
                'Origin' => self::URL
            ];
            $client = new Client(
                [
                    'headers' => $headers
                ]);
            $result = $client->post(self::URL, [RequestOptions::JSON => $fcmFields]);
            return json_decode($result->getBody()->getContents());
        }
    }
    
    /**
     * @param FcmProject $fcmProject
     * @return Collection
     */
    private function getAllServerKey(FcmProject $fcmProject): Collection
    {
        return $fcmProject->get();
    }
}