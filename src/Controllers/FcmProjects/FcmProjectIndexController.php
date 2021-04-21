<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Controllers\FcmProjects;

use DyanGalih\CoreUI\Components\Models\ButtonDeleteModel;
use DyanGalih\CoreUI\Components\Models\ButtonModel;
use DyanGalih\CoreUI\Components\Models\InputTextModel;
use DyanGalih\CoreUI\Components\Models\ModalModel;
use DyanGalih\CoreUI\Components\Models\TableModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use WebAppId\Fcm\Requests\FcmProjectSearchRequest;
use WebAppId\Fcm\Responses\FcmProjectResponse;
use WebAppId\Fcm\Services\FcmProjectService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author:
 * Date: 02:08:14
 * Time: 2021/04/18
 * Class FcmProjectIndexController
 * @package WebAppId\Fcm\Controllers\FcmProjects
 */
class FcmProjectIndexController
{
    /**
     * @param FcmProjectSearchRequest $fcmProjectSearchRequest
     * @param FcmProjectService $fcmProjectService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             FcmProjectSearchRequest $fcmProjectSearchRequest,
                             FcmProjectService $fcmProjectService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $fcmProjectSearchRequest->validated();

        $q = "";

        if(!empty($searchValue)) {
            if(isset($searchValue['q'])) {
                $q = $searchValue['q'];
            }else{
                $q = "";
            }
        }

        $result = app()->call([$fcmProjectService, 'get'], compact('q'));

        $fcmProjects = $result->fcmProjectList;

        $datas = [];
        $actions = [];
        $i = 0;
        $table = app()->make(TableModel::class);
        $table->headers = [
            "name" => __("fcm::fcm_project.name"),
            "server_key" => __("fcm::fcm_project.server_key"),
            "user_name" => __("fcm::fcm_project.user_id")
        ];
        if($fcmProjects!=null){
            foreach ($fcmProjects as $fcmProject) {
                $key = $fcmProject->id;
                $item = app()->make(FcmProjectResponse::class);
                $datas[] = Lazy::transform($fcmProject, $item);

                $urlEdit = route('lazy.admin.fcm-project.edit', $key);
                $buttonEdit = app()->make(ButtonModel::class);
                $buttonEdit->type = "button";
                $buttonEdit->style = "success";
                $buttonEdit->icon = "c-icon cil-pencil";
                $buttonEdit->title = "";
                $buttonEdit->onclick = "window.location.href='" . $urlEdit . "'";
                $actions[$i][] = $buttonEdit;

                $urlDelete = route('lazy.admin.fcm-project.delete', $key);
                $modal = app()->make(ModalModel::class);
                $modal->title = "Delete Confirmation";
                $modal->id = "modal-" . Str::slug($key);
                $modal->yesButton = "Delete";
                $modal->style = "danger";
                $modal->body = '    <div class="col text-center">
                                    <p class="text-primary h2">
                                        Are you sure want to delete this data?
                                    </p>
                                </div>';
                $modal->action = $urlDelete;

                $buttonDelete = app()->make(ButtonModel::class);
                $buttonDelete->type = "button";
                $buttonDelete->style = "danger";
                $buttonDelete->icon = "c-icon cil-trash";
                $buttonDelete->title = "";
                $buttonDelete->onclick = "";
                $buttonDelete->dataToggle = "modal";
                $buttonDelete->dataTarget = "#modal-" . Str::slug($key);

                $buttonDeleteModel = app()->make(ButtonDeleteModel::class);
                $buttonDeleteModel->buttonModel = $buttonDelete;
                $buttonDeleteModel->modalModel = $modal;
                $actions[$i][] = $buttonDeleteModel;
                $i++;
            }

            $table->pagging = $fcmProjects->links();
        }


        $table->datas = $datas;
        $table->actions = $actions;

        $data['datas'] = $table;

        $search = app()->make(InputTextModel::class);
        $search->name = "q";
        $search->required = "";
        $search->placeHolder = "Search";
        $search->value = $q;
        $search->noLabel = true;
        $search->hasColumn = false;

        $data['search'] = $search;

        $searchButton = app()->make(ButtonModel::class);
        $searchButton->title = "Search";
        $searchButton->style = "success";
        $searchButton->type = "submit";
        $data['searchButton'] = $searchButton;

        $addButton = app()->make(ButtonModel::class);
        $addButton->title = "New";
        $addButton->type = "button";
        $addButton->onclick = "window.location.href='" . route('lazy.admin.fcm-project.create') . "'";
        $addButton->icon = "cil-plus";
        $data['addButton'] = $addButton;

        $response->setData($data);
        $response->setView('fcm::modules.fcm_project.index');

        if ($result->status) {
            $response->setRecordsTotal($result->count);
            $response->setRecordsFiltered($result->countFiltered);
            return $smartResponse->success($response);
        } else {
            $response->setRecordsTotal(0);
            $response->setRecordsFiltered(0);
            return $smartResponse->dataNotFound($response);
        }
    }
}
