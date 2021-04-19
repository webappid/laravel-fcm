<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Repositories\Requests\FcmProjectRepositoryRequest;
use WebAppId\Fcm\Services\Requests\FcmProjectServiceRequest;
use WebAppId\Fcm\Services\Responses\FcmProjectServiceResponse;
use WebAppId\Fcm\Services\Responses\FcmProjectServiceResponseList;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 02:03:35
 * Time: 2021/04/18
 * Class FcmProjectServiceTrait
 * @package WebAppId\Fcm\Services
 */
trait FcmProjectServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(FcmProjectServiceRequest $fcmProjectServiceRequest, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProjectRepositoryRequest = Lazy::copy($fcmProjectServiceRequest, $fcmProjectRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$fcmProjectRepository, 'store'], ['fcmProjectRepositoryRequest' => $fcmProjectRepositoryRequest]);
        if ($result != null) {
            $fcmProjectServiceResponse->status = true;
            $fcmProjectServiceResponse->message = 'Store Data Success';
            $fcmProjectServiceResponse->fcmProject = $result;
        } else {
            $fcmProjectServiceResponse->status = false;
            $fcmProjectServiceResponse->message = 'Store Data Failed';
        }

        return $fcmProjectServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FcmProjectServiceRequest $fcmProjectServiceRequest, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProjectRepositoryRequest = Lazy::copy($fcmProjectServiceRequest, $fcmProjectRepositoryRequest, Lazy::AUTOCAST);

        $result = app()->call([$fcmProjectRepository, 'update'], ['id' => $id, 'fcmProjectRepositoryRequest' => $fcmProjectRepositoryRequest]);
        if ($result != null) {
            $fcmProjectServiceResponse->status = true;
            $fcmProjectServiceResponse->message = 'Update Data Success';
            $fcmProjectServiceResponse->fcmProject = $result;
        } else {
            $fcmProjectServiceResponse->status = false;
            $fcmProjectServiceResponse->message = 'Update Data Failed';
        }

        return $fcmProjectServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $status = app()->call([$fcmProjectRepository, 'delete'], compact('id'));
        $fcmProjectServiceResponse->status = $status;
        if($status){
            $fcmProjectServiceResponse->message = "Delete Success";
        }else{
            $fcmProjectServiceResponse->message = "Delete Failed";
        }

        return $fcmProjectServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @return FcmProjectServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, FcmProjectServiceResponseList $fcmProjectServiceResponseList): FcmProjectServiceResponseList{
        if (count($result) > 0) {
            $fcmProjectServiceResponseList->status = true;
            $fcmProjectServiceResponseList->message = 'Data Found';
            $fcmProjectServiceResponseList->fcmProjectList = $result;
            $fcmProjectServiceResponseList->count = $result->total();
            $fcmProjectServiceResponseList->countFiltered = $result->count();
        } else {
            $fcmProjectServiceResponseList->status = false;
            $fcmProjectServiceResponseList->message = 'Data Not Found';
        }
        return $fcmProjectServiceResponseList;
    }

    /**
     * @param FcmProject $fcmProject
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    private function formatResult(FcmProject $fcmProject, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse{
        if($fcmProject == null){
            $fcmProjectServiceResponse->status = false;
            $fcmProjectServiceResponse->message = "Data Not Found";
        }else{
            $fcmProjectServiceResponse->status = true;
            $fcmProjectServiceResponse->message = "Data Found";
            $fcmProjectServiceResponse->fcmProject = $fcmProject;
        }

        return $fcmProjectServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, int $length = 12, string $q = null): FcmProjectServiceResponseList
    {
        $result = app()->call([$fcmProjectRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $fcmProjectServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(FcmProjectRepository $fcmProjectRepository, string $q = null): int
    {
        return app()->call([$fcmProjectRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getById'], compact('id'));
        return $this->formatResult($fcmProject, $fcmProjectServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null,  int $length = 12): FcmProjectServiceResponseList
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmProject, $fcmProjectServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserApiToken'], compact('apiToken'));
        return $this->formatResult($fcmProject, $fcmProjectServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null,  int $length = 12): FcmProjectServiceResponseList
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserApiTokenList'], compact('apiToken', 'length', 'q'));
        return $this->formatResultList($fcmProject, $fcmProjectServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserEmail'], compact('email'));
        return $this->formatResult($fcmProject, $fcmProjectServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null,  int $length = 12): FcmProjectServiceResponseList
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserEmailList'], compact('email', 'length', 'q'));
        return $this->formatResultList($fcmProject, $fcmProjectServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserId'], compact('id'));
        return $this->formatResult($fcmProject, $fcmProjectServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null,  int $length = 12): FcmProjectServiceResponseList
    {
        $fcmProject = app()->call([$fcmProjectRepository, 'getByUserIdList'], compact('id', 'length', 'q'));
        return $this->formatResultList($fcmProject, $fcmProjectServiceResponseList);
    }

}
