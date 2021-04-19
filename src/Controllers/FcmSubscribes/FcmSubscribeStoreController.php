<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace WebAppId\Fcm\Controllers\FcmSubscribes;

use Exception;
use Illuminate\Support\Facades\Auth;
use WebAppId\Fcm\Requests\FcmSubscribeRequest;
use WebAppId\Fcm\Services\FcmSubscribeService;
use WebAppId\Fcm\Services\Requests\FcmSubscribeServiceRequest;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author:
 * Date: 04:26:43
 * Time: 2021/04/18
 * Class FcmSubscribeStoreController
 * @package WebAppId\Fcm\Controllers\FcmSubscribes
 */
class FcmSubscribeStoreController
{
    /**
     * @param FcmSubscribeRequest $fcmSubscribeRequest
     * @param FcmSubscribeServiceRequest $fcmSubscribeServiceRequest
     * @param FcmSubscribeService $fcmSubscribeService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(FcmSubscribeRequest $fcmSubscribeRequest,
                             FcmSubscribeServiceRequest $fcmSubscribeServiceRequest,
                             FcmSubscribeService $fcmSubscribeService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        if(!Auth::check()){
            $response->setMessage("Login Required");
            return $smartResponse->saveDataFailed($response);
        }

        $fcmSubscribeValidated = $fcmSubscribeRequest->validated();

        $fcmSubscribeServiceRequest = Lazy::copyFromArray($fcmSubscribeValidated, $fcmSubscribeServiceRequest, Lazy::AUTOCAST);

        $fcmSubscribeServiceRequest->user_id = Auth::user()->id;
        $fcmSubscribeServiceRequest->creator_id = Auth::user()->id;
        $fcmSubscribeServiceRequest->owner_id = Auth::user()->id;

        $result = app()->call([$fcmSubscribeService, 'store'], ['fcmSubscribeServiceRequest' => $fcmSubscribeServiceRequest]);

        if ($result->status) {
            $response->setData($result->fcmSubscribe);
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage($result->message);
            return $smartResponse->saveDataFailed($response);
        }
    }
}
