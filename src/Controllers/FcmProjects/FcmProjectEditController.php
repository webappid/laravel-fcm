<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Controllers\FcmProjects;

use DyanGalih\CoreUI\Components\Models\ButtonSubmitGroupModel;
use DyanGalih\CoreUI\Components\Models\InputTextModel;
use DyanGalih\CoreUI\Components\Models\SelectModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\UserService;

/**
 * @author: 
 * Date: 02:34:41
 * Time: 2021/04/18
 * Class FcmProjectEditController
 * @package WebAppId\Fcm\Controllers\FcmProjects
 */
class FcmProjectEditController
{
    /**
     * @param int $id
     * @param FcmProjectService $fcmProjectService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @param UserService $userService;
     * @return mixed
     * @throws BindingResolutionException
     */
    public function __invoke(int $id,
                             FcmProjectService $fcmProjectService,
                             UserService $userService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $resultFcmProject = app()->call([$fcmProjectService, 'getById'], compact('id'));

        $response->setView('fcm::modules.fcm_project.edit');

        $groupButton = app()->make(ButtonSubmitGroupModel::class);
        $groupButton->backurl = route('lazy.admin.fcm-project.index',  request()->query->all());

        $data = [];
        $data['groupButton'] = $groupButton;
        $fcmProject = $resultFcmProject->fcmProject;
        $data['fcmProject'] = $fcmProject;

        $userService = app()->call([$userService, "getById"], ["id" => $resultFcmProject->fcmProject->user_id]);
        $data['users'] = [0 => $userService->user->toArray()];

        $inputName = app()->make(InputTextModel::class);
        $inputName->name = "name";
        $inputName->placeHolder = __('fcm::fcm_project.name');
        $inputName->value = isset($fcmProject->name)?$fcmProject->name:"";
        $inputName->required = "required";
        $data['inputName'] = $inputName;

        $inputServerKey = app()->make(InputTextModel::class);
        $inputServerKey->name = "server_key";
        $inputServerKey->placeHolder = __('fcm::fcm_project.server_key');
        $inputServerKey->value = isset($fcmProject->server_key)?$fcmProject->server_key:"";
        $inputServerKey->required = "required";
        $data['inputServerKey'] = $inputServerKey;

        $response->setData($data);
        if($resultFcmProject->status){
            return $smartResponse->success($response);
        }else{
            return $smartResponse->dataNotFound($response);
        }
    }
}
