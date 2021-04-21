<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Controllers\Notifications;

use DyanGalih\CoreUI\Components\Models\ButtonDeleteModel;
use DyanGalih\CoreUI\Components\Models\ButtonModel;
use DyanGalih\CoreUI\Components\Models\InputTextModel;
use DyanGalih\CoreUI\Components\Models\ModalModel;
use DyanGalih\CoreUI\Components\Models\TableModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use WebAppId\Fcm\Requests\NotificationSearchRequest;
use WebAppId\Fcm\Responses\NotificationResponse;
use WebAppId\Fcm\Services\NotificationService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 08:09:40
 * Time: 2021/04/20
 * Class NotificationIndexController
 * @package WebAppId\Fcm\Controllers\Notifications
 */
class NotificationIndexController
{
    /**
     * @param NotificationSearchRequest $notificationSearchRequest
     * @param NotificationService $notificationService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             NotificationSearchRequest $notificationSearchRequest,
                             NotificationService $notificationService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $notificationSearchRequest->validated();

        $q = "";

        if(!empty($searchValue)) {
            if(isset($searchValue['q'])) {
                $q = $searchValue['q'];
            }else{
                $q = "";
            }
        }

        $result = app()->call([$notificationService, 'get'], compact('q'));

        $notifications = $result->notificationList;

        $datas = [];
        $actions = [];
        $i = 0;
        $table = app()->make(TableModel::class);
        $table->headers = [
            "code" => __("notification.code"),
            "user_id" => __("notification.user_id"),
            "receiver_id" => __("notification.receiver_id"),
            "title" => __("notification.title"),
            "body" => __("notification.body"),
            "action" => __("notification.action")
        ];
        if($notifications!=null){
            foreach ($notifications as $notification) {
                $key = $notification->code;
                $item = app()->make(NotificationResponse::class);
                $datas[] = Lazy::transform($notification, $item);

                $urlEdit = route('lazy.notification.edit', $key);
                $buttonEdit = app()->make(ButtonModel::class);
                $buttonEdit->type = "button";
                $buttonEdit->style = "success";
                $buttonEdit->icon = "c-icon cil-pencil";
                $buttonEdit->title = "";
                $buttonEdit->onclick = "window.location.href='" . $urlEdit . "'";
                $actions[$i][] = $buttonEdit;

                $urlDelete = route('lazy.notification.delete', $key);
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

            $table->pagging = $notifications->links();
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
        $addButton->onclick = "window.location.href='" . route('lazy.notification.create') . "'";
        $addButton->icon = "cil-plus";
        $data['addButton'] = $addButton;

        $response->setData($data);
        $response->setView('modules.notification.index');

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
