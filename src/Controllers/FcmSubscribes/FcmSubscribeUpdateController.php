<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Controllers\FcmSubscribes;

use Illuminate\Support\Facades\Auth;
use WebAppId\Fcm\Requests\FcmSubscribeRequest;
use WebAppId\Fcm\Services\FcmSubscribeService;
use WebAppId\Fcm\Services\Requests\FcmSubscribeServiceRequest;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 04:28:18
 * Time: 2021/04/18
 * Class FcmSubscribeUpdateController
 * @package WebAppId\Fcm\Controllers\FcmSubscribes
 */
class FcmSubscribeUpdateController
{
    public function __invoke(FcmSubscribeRequest $fcmSubscribeRequest,
                             FcmSubscribeServiceRequest $fcmSubscribeServiceRequest,
                             FcmSubscribeService $fcmSubscribeService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $fcmSubscribeValidated = $fcmSubscribeRequest->validated();

        $fcmSubscribeServiceRequest = Lazy::copyFromArray($fcmSubscribeValidated, $fcmSubscribeServiceRequest, Lazy::AUTOCAST);

        $fcmSubscribeServiceRequest->user_id = Auth::user()->id;
        $fcmSubscribeServiceRequest->creator_id = Auth::user()->id;
        $fcmSubscribeServiceRequest->owner_id = Auth::user()->id;
        
        $currentSubscribe = app()->call([$fcmSubscribeService,'getByUserId'], ['id' => $fcmSubscribeServiceRequest->user_id]);
        
        if($currentSubscribe->status){
            $result = app()->call([$fcmSubscribeService, 'update'], ['id' => $id, 'fcmSubscribeServiceRequest' => $fcmSubscribeServiceRequest]);
            $updateStatus = $result->status;
        }else{
            $updateStatus = $currentSubscribe->status;
        }

        if ($updateStatus) {
            $response->setRedirect(route('lazy.admin.fcm-subscribe.index', request()->query->all()));
            $response->setData($result->fcmSubscribe);
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setRedirect(route('lazy.admin.fcm-subscribe.edit', array_merge(['id' => $id], request()->query->all())));
            return $smartResponse->saveDataFailed($response);
        }
    }
}
