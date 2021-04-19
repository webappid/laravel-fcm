<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Controllers\FcmProjects;

use Illuminate\Support\Facades\Auth;
use WebAppId\Fcm\Requests\FcmProjectRequest;
use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\Fcm\Services\Requests\FcmProjectServiceRequest;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author:
 * Date: 04:06:28
 * Time: 2021/04/18
 * Class FcmProjectUpdateController
 * @package WebAppId\Fcm\Controllers\FcmProjects
 */
class FcmProjectUpdateController
{
    public function __invoke(int $id,
                             FcmProjectRequest $fcmProjectRequest,
                             FcmProjectServiceRequest $fcmProjectServiceRequest,
                             FcmProjectService $fcmProjectService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $fcmProjectValidated = $fcmProjectRequest->validated();

        $fcmProjectServiceRequest = Lazy::copyFromArray($fcmProjectValidated, $fcmProjectServiceRequest, Lazy::AUTOCAST);

        $fcmProjectServiceRequest->user_id = Auth::user()->id;

        $result = app()->call([$fcmProjectService, 'update'], ['id' => $id, 'fcmProjectServiceRequest' => $fcmProjectServiceRequest]);

        if ($result->status) {
            $response->setRedirect(route('lazy.admin.fcm-project.index', request()->query->all()));
            $response->setData($result->fcmProject);
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setRedirect(route('lazy.admin.fcm-project.edit', array_merge(['id' => $id], request()->query->all())));
            return $smartResponse->saveDataFailed($response);
        }
    }
}
