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
    private const URL_SUBSCRIBE_TOPIC = 'https://iid.googleapis.com/iid/v1/%s/rel/topics/%s';
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param array $data
     * @param array $registrationIds
     * @param FcmProject $fcmProject
     * @return array
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmProject $fcmProject,
                              array $data = []): array
    {
        
        
        $payloads = [];
        $payloads['registration_ids'] = $registrationIds;
        
        return $this->sendBlastFcm($fcmSendParam, $payloads, $fcmProject, $data);
    }
    
    /**
     * @param $fcmSendParam
     * @param $payloads
     * @param FcmProject $fcmProject
     * @return array
     */
    private function sendBlastFcm($fcmSendParam, $payloads, FcmProject $fcmProject, $data)
    {
        $pt = new PopoTools();
        if (count($data) > 0) {
            $payloads['data'] = $data;
        }
        try {
            $payloads['notification'] = $pt->serialize($fcmSendParam);
        } catch (\ReflectionException $e) {
            report($e);
        }
        
        $payloads['priority'] = 'high';
        $serverKeys = $this->getAllServerKey($fcmProject);
        $resultList = [];
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
            $result = $client->post(self::URL, [RequestOptions::JSON => $payloads]);
            $resultList[] = json_decode($result->getBody()->getContents());
            
        }
        return $resultList;
    }
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param string $topic
     * @param FcmProject $fcmProject
     * @param array $data
     * @return array
     */
    public function sendToTopic(FcmSendParam $fcmSendParam,
                                string $topic,
                                FcmProject $fcmProject,
                                array $data = []): array
    {
        $payloads = [];
        $payloads['to'] = '/topics/' . $topic;
        
        return $this->sendBlastFcm($fcmSendParam, $payloads, $fcmProject, $data);
    }
    
    /**
     * @param FcmProject $fcmProject
     * @return Collection
     */
    private function getAllServerKey(FcmProject $fcmProject): Collection
    {
        return $fcmProject->get();
    }
    
    /**
     * @param string $token
     * @param string $topic
     * @param FcmProject $fcmProject
     * @return array
     */
    public function subscribeTopic(string $token, string $topic, FcmProject $fcmProject): array
    {
        $serverKeys = $this->getAllServerKey($fcmProject);
        $resultList = [];
        $url = sprintf(self::URL_SUBSCRIBE_TOPIC, $token, $topic);
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
            $result = $client->post($url, []);
            $resultList[] = json_decode($result->getStatusCode());
            
        }
        return $resultList;
    }
}