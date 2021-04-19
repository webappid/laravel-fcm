<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace WebAppId\Fcm\Controllers\FcmProjects;

use Exception;
use Illuminate\Support\Facades\Auth;
use WebAppId\Fcm\Requests\FcmProjectRequest;
use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\Fcm\Services\Requests\FcmProjectServiceRequest;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author:
 * Date: 04:05:45
 * Time: 2021/04/18
 * Class FcmProjectStoreController
 * @package WebAppId\Fcm\Controllers\FcmProjects
 */
class FcmProjectStoreController
{
    /**
     * @param FcmProjectRequest $fcmProjectRequest
     * @param FcmProjectServiceRequest $fcmProjectServiceRequest
     * @param FcmProjectService $fcmProjectService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(FcmProjectRequest $fcmProjectRequest,
                             FcmProjectServiceRequest $fcmProjectServiceRequest,
                             FcmProjectService $fcmProjectService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $fcmProjectValidated = $fcmProjectRequest->validated();

        $fcmProjectServiceRequest = Lazy::copyFromArray($fcmProjectValidated, $fcmProjectServiceRequest, Lazy::AUTOCAST);

        $fcmProjectServiceRequest->user_id = Auth::user()->id;

        $result = app()->call([$fcmProjectService, 'store'], ['fcmProjectServiceRequest' => $fcmProjectServiceRequest]);

        if ($result->status) {
            $response->setRedirect(route('lazy.admin.fcm-project.index', request()->query->all()));
            $response->setData($result->fcmProject);
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setRedirect(route('lazy.admin.fcm-project.create', request()->query->all()));
            return $smartResponse->saveDataFailed($response);
        }
    }
}
