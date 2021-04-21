<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace WebAppId\Fcm\Controllers\FcmProjects;

use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author:
 * Date: 04:07:11
 * Time: 2021/04/18
 * Class FcmProjectDeleteController
 * @package WebAppId\Fcm\Controllers\FcmProjects
 */
class FcmProjectDeleteController
{
    /**
     * @param int $id
     * @param FcmProjectService $fcmProjectService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $id,
                             FcmProjectService $fcmProjectService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$fcmProjectService, 'delete'], compact('id'));

        $response->setRedirect(route('lazy.admin.fcm-project.index'));

        if ($result->status) {
            return $smartResponse->saveDataSuccess($response);
        } else {
            return $smartResponse->saveDataFailed($response);
        }
    }
}
