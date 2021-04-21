<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Repositories\Requests\FcmSubscribeRepositoryRequest;
use WebAppId\Fcm\Services\Requests\FcmSubscribeServiceRequest;
use WebAppId\Fcm\Services\Responses\FcmSubscribeServiceResponse;
use WebAppId\Fcm\Services\Responses\FcmSubscribeServiceResponseList;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 04:25:57
 * Time: 2021/04/18
 * Class FcmSubscribeServiceTrait
 * @package WebAppId\Fcm\Services
 */
trait FcmSubscribeServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(FcmSubscribeServiceRequest $fcmSubscribeServiceRequest, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribeRepositoryRequest = Lazy::copy($fcmSubscribeServiceRequest, $fcmSubscribeRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$fcmSubscribeRepository, 'store'], ['fcmSubscribeRepositoryRequest' => $fcmSubscribeRepositoryRequest]);
        if ($result != null) {
            $fcmSubscribeServiceResponse->status = true;
            $fcmSubscribeServiceResponse->message = 'Store Data Success';
            $fcmSubscribeServiceResponse->fcmSubscribe = $result;
        } else {
            $fcmSubscribeServiceResponse->status = false;
            $fcmSubscribeServiceResponse->message = 'Store Data Failed';
        }

        return $fcmSubscribeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FcmSubscribeServiceRequest $fcmSubscribeServiceRequest, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribeRepositoryRequest = Lazy::copy($fcmSubscribeServiceRequest, $fcmSubscribeRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$fcmSubscribeRepository, 'update'], ['id' => $id, 'fcmSubscribeRepositoryRequest' => $fcmSubscribeRepositoryRequest]);
        if ($result != null) {
            $fcmSubscribeServiceResponse->status = true;
            $fcmSubscribeServiceResponse->message = 'Update Data Success';
            $fcmSubscribeServiceResponse->fcmSubscribe = $result;
        } else {
            $fcmSubscribeServiceResponse->status = false;
            $fcmSubscribeServiceResponse->message = 'Update Data Failed';
        }

        return $fcmSubscribeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $status = app()->call([$fcmSubscribeRepository, 'delete'], compact('id'));
        $fcmSubscribeServiceResponse->status = $status;
        if($status){
            $fcmSubscribeServiceResponse->message = "Delete Success";
        }else{
            $fcmSubscribeServiceResponse->message = "Delete Failed";
        }

        return $fcmSubscribeServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @return FcmSubscribeServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList): FcmSubscribeServiceResponseList{
        if (count($result) > 0) {
            $fcmSubscribeServiceResponseList->status = true;
            $fcmSubscribeServiceResponseList->message = 'Data Found';
            $fcmSubscribeServiceResponseList->fcmSubscribeList = $result;
            $fcmSubscribeServiceResponseList->count = $result->total();
            $fcmSubscribeServiceResponseList->countFiltered = $result->count();
        } else {
            $fcmSubscribeServiceResponseList->status = false;
            $fcmSubscribeServiceResponseList->message = 'Data Not Found';
        }
        return $fcmSubscribeServiceResponseList;
    }

    /**
     * @param FcmSubscribe $fcmSubscribe
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    private function formatResult(FcmSubscribe $fcmSubscribe, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse{
        if($fcmSubscribe == null){
            $fcmSubscribeServiceResponse->status = false;
            $fcmSubscribeServiceResponse->message = "Data Not Found";
        }else{
            $fcmSubscribeServiceResponse->status = true;
            $fcmSubscribeServiceResponse->message = "Data Found";
            $fcmSubscribeServiceResponse->fcmSubscribe = $fcmSubscribe;
        }

        return $fcmSubscribeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, int $length = 12, string $q = null): FcmSubscribeServiceResponseList
    {
        $result = app()->call([$fcmSubscribeRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(FcmSubscribeRepository $fcmSubscribeRepository, string $q = null): int
    {
        return app()->call([$fcmSubscribeRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByToken(string $token, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByToken'], compact('token'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByTokenList(string $token, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByTokenList'], compact('token', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getById'], compact('id'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByFcmProjectId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByFcmProjectId'], compact('id'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByFcmProjectIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByFcmProjectIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserApiToken'], compact('apiToken'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserEmail'], compact('email'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserId'], compact('id'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByOwnerUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserApiToken'], compact('apiToken'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserEmail'], compact('email'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserId'], compact('id'));
        return $this->formatResult($fcmSubscribe, $fcmSubscribeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null,  int $length = 12): FcmSubscribeServiceResponseList
    {
        $fcmSubscribe = app()->call([$fcmSubscribeRepository, 'getByUserUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmSubscribe, $fcmSubscribeServiceResponseList);
    }

}
