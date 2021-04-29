<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 12:57
 */

namespace WebAppId\Fcm\Services;


use Illuminate\Support\Facades\Auth;
use WebAppId\DDD\Services\BaseService;
use WebAppId\Fcm\Models\Fcm;
use WebAppId\Fcm\Repositories\FcmLogRepository;
use WebAppId\Fcm\Repositories\FcmRepository;
use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Repositories\Requests\FcmLogRepositoryRequest;
use WebAppId\Fcm\Repositories\Requests\FcmRepositoryRequest;
use WebAppId\Fcm\Responses\FcmResponse;
use WebAppId\Fcm\Services\Contracts\FcmServiceContract;
use WebAppId\Fcm\Services\Params\FcmSendParam;
use WebAppId\Fcm\Services\Requests\FcmSendServiceRequest;

class FcmService extends BaseService implements FcmServiceContract
{

    /**
     * @param int $id
     * @param FcmSendServiceRequest $fcmSendServiceRequest
     * @param FcmRepository $fcmRepository
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmLogRepository $fcmLogRepository
     */
    public function send(
        int $id,
        FcmSendServiceRequest $fcmSendServiceRequest,
        FcmRepository $fcmRepository,
        FcmSubscribeRepository $fcmSubscribeRepository,
        FcmLogRepository $fcmLogRepository
    )
    {
        $services = app()->call([$fcmSubscribeRepository, 'getByOwnerUserIdList'], compact('id'));
        if (count($services) > 0) {
            foreach ($services as $service) {
                $fcmRepositoryRequest = app()->make(FcmRepositoryRequest::class);
                $fcmRepositoryRequest->registration_ids[] = $service->token;
                $fcmRepositoryRequest->notification = $fcmSendServiceRequest->notification;
                $fcmRepositoryRequest->datas = $fcmSendServiceRequest->datas;

                $result = app()->call([$fcmRepository, 'sendFcm'], [
                    "serverKey" => $service->server_key,
                    "url" => Fcm::URL,
                    "fcmRepositoryRequest" => $fcmRepositoryRequest
                ]);

                if ($service->id != null) {
                    $fcmLogRepositoryRequest = app()->make(FcmLogRepositoryRequest::class);
                    $fcmLogRepositoryRequest->user_id = Auth::id();
                    $fcmLogRepositoryRequest->request = json_encode($fcmRepositoryRequest);
                    $fcmLogRepositoryRequest->response = $result;
                    $fcmLogRepositoryRequest->fcm_subscribe_id = $service->id;
                    app()->call([$fcmLogRepository, 'store'], compact('fcmLogRepositoryRequest'));
                }
            }
        }
    }

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
                              array $data = []): void
    {
        $this->getContainer()->call([$fcmRepository, 'sendBlast'],
            [
                'fcmSendParam' => $fcmSendParam,
                'registrationIds' => $registrationIds,
                'data' => $data
            ]);

    }

    /**
     * @param FcmSendParam $fcmSendParam
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @param FcmResponse $fcmResponse
     * @param array $data
     * @return void
     */
    public function sendToTopic(FcmSendParam $fcmSendParam, string $topic, FcmRepository $fcmRepository, FcmResponse $fcmResponse, array $data = []): void
    {
        $this->getContainer()->call([$fcmRepository, 'sendToTopic'], ['fcmSendParam' => $fcmSendParam, 'topic' => $topic]);
    }

    /**
     * @param string $token
     * @param string $topic
     * @param FcmRepository $fcmRepository
     * @return void
     */
    public function subscribeTopic(string $token, string $topic, FcmRepository $fcmRepository): void
    {
        $this->getContainer()->call([$fcmRepository, 'subscribeTopic'], ['token' => $token, 'topic' => $topic]);
    }
}
