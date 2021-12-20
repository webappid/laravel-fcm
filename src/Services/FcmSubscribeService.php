<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services;

use Illuminate\Support\Facades\Auth;
use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Repositories\Requests\FcmSubscribeRepositoryRequest;
use WebAppId\Fcm\Services\Requests\FcmSubscribeServiceRequest;
use WebAppId\Fcm\Services\Responses\FcmSubscribeServiceResponse;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author:
 * Date: 04:26:02
 * Time: 2021/04/18
 * Class FcmSubscribeService
 * @package WebAppId\Fcm\Services
 */
class FcmSubscribeService
{
    use FcmSubscribeServiceTrait {
        store as baseStore;
    }

    /**
     * @param FcmSubscribeServiceRequest $fcmSubscribeServiceRequest
     * @param FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function store(FcmSubscribeServiceRequest $fcmSubscribeServiceRequest,
                          FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest,
                          FcmSubscribeRepository $fcmSubscribeRepository,
                          FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $currentToken = app()->call([$fcmSubscribeRepository, 'getByToken'], ['token' => $fcmSubscribeServiceRequest->token]);

        if ($currentToken != null) {
            if ($currentToken->user_id == Auth::id()) {
                $fcmSubscribeServiceResponse->status = false;
                $fcmSubscribeServiceResponse->message = "Token Already Registered";
                return $fcmSubscribeServiceResponse;
            } else {
                $fcmSubscribeRepositoryRequest = Lazy::transform($currentToken, $fcmSubscribeRepositoryRequest);
                $fcmSubscribeRepositoryRequest->user_id = Auth::id();
                $fcmSubscribeRepositoryRequest->owner_id = Auth::id();
                $fcmSubscribeRepositoryRequest->creator_id = Auth::id();
                $update = app()->call([$fcmSubscribeRepository, 'update'], ['id' => $currentToken->id, 'fcmSubscribeRepositoryRequest' => $fcmSubscribeRepositoryRequest]);
                if($update == null){
                    $fcmSubscribeServiceResponse->status = false;
                    $fcmSubscribeServiceResponse->message = "Update Token Failed";
                    return $fcmSubscribeServiceResponse;
                }else{
                    $fcmSubscribeServiceResponse->status = true;
                    $fcmSubscribeServiceResponse->message = "Update Token Successed";
                    return $fcmSubscribeServiceResponse;
                }
            }
        }

        return $this->baseStore(
            $fcmSubscribeServiceRequest,
            $fcmSubscribeRepositoryRequest,
            $fcmSubscribeRepository,
            $fcmSubscribeServiceResponse
        );

    }
}
