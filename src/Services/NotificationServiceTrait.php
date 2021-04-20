<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\Notification;
use WebAppId\Fcm\Repositories\NotificationRepository;
use WebAppId\Fcm\Repositories\Requests\NotificationRepositoryRequest;
use WebAppId\Fcm\Services\Requests\NotificationServiceRequest;
use WebAppId\Fcm\Services\Responses\NotificationServiceResponse;
use WebAppId\Fcm\Services\Responses\NotificationServiceResponseList;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 08:09:30
 * Time: 2021/04/20
 * Class NotificationServiceTrait
 * @package WebAppId\Fcm\Services
 */
trait NotificationServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(NotificationServiceRequest $notificationServiceRequest, NotificationRepositoryRequest $notificationRepositoryRequest, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notificationRepositoryRequest = Lazy::copy($notificationServiceRequest, $notificationRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$notificationRepository, 'store'], ['notificationRepositoryRequest' => $notificationRepositoryRequest]);
        if ($result != null) {
            $notificationServiceResponse->status = true;
            $notificationServiceResponse->message = 'Store Data Success';
            $notificationServiceResponse->notification = $result;
        } else {
            $notificationServiceResponse->status = false;
            $notificationServiceResponse->message = 'Store Data Failed';
        }

        return $notificationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(string $code, NotificationServiceRequest $notificationServiceRequest, NotificationRepositoryRequest $notificationRepositoryRequest, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notificationRepositoryRequest = Lazy::copy($notificationServiceRequest, $notificationRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$notificationRepository, 'update'], ['code' => $code, 'notificationRepositoryRequest' => $notificationRepositoryRequest]);
        if ($result != null) {
            $notificationServiceResponse->status = true;
            $notificationServiceResponse->message = 'Update Data Success';
            $notificationServiceResponse->notification = $result;
        } else {
            $notificationServiceResponse->status = false;
            $notificationServiceResponse->message = 'Update Data Failed';
        }

        return $notificationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $code, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $status = app()->call([$notificationRepository, 'delete'], compact('code'));
        $notificationServiceResponse->status = $status;
        if($status){
            $notificationServiceResponse->message = "Delete Success";
        }else{
            $notificationServiceResponse->message = "Delete Failed";
        }

        return $notificationServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @return NotificationServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, NotificationServiceResponseList $notificationServiceResponseList): NotificationServiceResponseList{
        if (count($result) > 0) {
            $notificationServiceResponseList->status = true;
            $notificationServiceResponseList->message = 'Data Found';
            $notificationServiceResponseList->notificationList = $result;
            $notificationServiceResponseList->count = $result->total();
            $notificationServiceResponseList->countFiltered = $result->count();
        } else {
            $notificationServiceResponseList->status = false;
            $notificationServiceResponseList->message = 'Data Not Found';
        }
        return $notificationServiceResponseList;
    }

    /**
     * @param Notification $notification
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    private function formatResult(Notification $notification, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse{
        if($notification == null){
            $notificationServiceResponse->status = false;
            $notificationServiceResponse->message = "Data Not Found";
        }else{
            $notificationServiceResponse->status = true;
            $notificationServiceResponse->message = "Data Found";
            $notificationServiceResponse->notification = $notification;
        }

        return $notificationServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, int $length = 12, string $q = null): NotificationServiceResponseList
    {
        $result = app()->call([$notificationRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(NotificationRepository $notificationRepository, string $q = null): int
    {
        return app()->call([$notificationRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByCode(string $code, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByCode'], compact('code'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCodeList(string $code, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByCodeList'], compact('code', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getById'], compact('id'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserApiToken'], compact('apiToken'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmail(string $email, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserEmail'], compact('email'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserId(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserId'], compact('id'));
        return $this->formatResult($notification, $notificationServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null,  int $length = 12): NotificationServiceResponseList
    {
        $notification = app()->call([$notificationRepository, 'getByUserUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($notification, $notificationServiceResponseList);
    }

}
