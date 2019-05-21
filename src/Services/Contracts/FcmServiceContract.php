<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 12:55
 */

namespace WebAppId\Fcm\Services\Contracts;


use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmRepository;
use WebAppId\Fcm\Responses\FcmResponse;
use WebAppId\Fcm\Services\Params\FcmSendParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface FcmServiceContract
{
    /**
     * @param FcmSendParam $fcmSendParam
     * @param array $registrationIds
     * @param FcmRepository $fcmRepository
     * @param FcmResponse $fcmResponse
     * @param array $data
     * @return void
     */
    public function sendBlast(FcmSendParam $fcmSendParam,
                              array $registrationIds,
                              FcmRepository $fcmRepository,
                              FcmResponse $fcmResponse,
                              array $data = []): void ;
    
    /**
     * @param FcmSendParam $fcmSendParam
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @param FcmResponse $fcmResponse
     * @param array $data
     * @return void
     */
    public function sendToTopic(FcmSendParam $fcmSendParam,
                                string $topic,
                                FcmRepository $fcmRepository,
                                FcmResponse $fcmResponse,
                                array $data = []): void ;
    
    /**
     * @param string $token
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @return void
     */
    public function subscribeTopic(string $token,
                                   string $topic,
                                   FcmRepository $fcmRepository): void ;
}