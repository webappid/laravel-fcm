<?php
/**
 * Author: galih
 * Date: 2019-05-17
 * Time: 20:40
 */

namespace WebAppId\Fcm\Repositories\Contracts;


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
     * @param array $data
     * @param array $registrationIds
     * @param FcmProject $fcmProject
     * @return array
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmProject $fcmProject,
                              array $data): array;
    
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
                                array $data = []): array;
    
    /**
     * @param string $token
     * @param string $topic
     * @param FcmProject $fcmProject
     * @return array
     */
    public function subscribeTopic(string $token, string $topic, FcmProject $fcmProject): array;
}