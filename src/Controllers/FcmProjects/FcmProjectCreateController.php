<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Controllers\FcmProjects;
use DyanGalih\CoreUI\Components\Models\ButtonSubmitGroupModel;
use DyanGalih\CoreUI\Components\Models\InputTextModel;
use DyanGalih\CoreUI\Components\Models\SelectModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
/**
 * @author:
 * Date: 02:24:45
 * Time: 2021/04/18
 * Class FcmProjectCreateController
 * @package WebAppId\Fcm\Http\Controllers\FcmProjects
 */
class FcmProjectCreateController
{
    /**
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws BindingResolutionException
     */
    public function __invoke(
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $groupButton = app()->make(ButtonSubmitGroupModel::class);
        $groupButton->backurl = route('lazy.admin.fcm-project.index',  request()->query->all());
        $data = [];
        $data['groupButton'] = $groupButton;
        $inputName = app()->make(InputTextModel::class);
        $inputName->name = "name";
        $inputName->placeHolder = __('fcm::fcm_project.name');
        $inputName->value = "";
        $inputName->required = "required";
        $data['inputName'] = $inputName;

        $inputServerKey = app()->make(InputTextModel::class);
        $inputServerKey->name = "server_key";
        $inputServerKey->placeHolder = __('fcm::fcm_project.server_key');
        $inputServerKey->value = "";
        $inputServerKey->required = "required";
        $data['inputServerKey'] = $inputServerKey;

        $response->setData($data);
        $response->setView('fcm::modules.fcm_project.create');
        return $smartResponse->success($response);
    }
}
