<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Contracts;

use WebAppId\Fcm\Repositories\FcmSubscribeRepository;
use WebAppId\Fcm\Repositories\Requests\FcmSubscribeRepositoryRequest;
use WebAppId\Fcm\Services\Requests\FcmSubscribeServiceRequest;
use WebAppId\Fcm\Services\Responses\FcmSubscribeServiceResponse;
use WebAppId\Fcm\Services\Responses\FcmSubscribeServiceResponseList;

/**
 * @author: 
 * Date: 04:26:02
 * Time: 2021/04/18
 * Class FcmSubscribeServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface FcmSubscribeServiceContract
{
    /**
     * @param FcmSubscribeServiceRequest $fcmSubscribeServiceRequest
     * @param FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function store(FcmSubscribeServiceRequest $fcmSubscribeServiceRequest, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeServiceRequest $fcmSubscribeServiceRequest
     * @param FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function update(int $id, FcmSubscribeServiceRequest $fcmSubscribeServiceRequest, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     */
    public function delete(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string|null $q
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
    public function get(FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList,int $length = 12, string $q = null): FcmSubscribeServiceResponseList;

    /**
     * @param string|null $q
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @return int
     */
    public function getCount(FcmSubscribeRepository $fcmSubscribeRepository, string $q = null):int;

    /**
     * @param string $token
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByToken(string $token, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $token
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByTokenList(string $token, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getById(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByFcmProjectId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByFcmProjectIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByOwnerUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByOwnerUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByOwnerUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByOwnerUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByOwnerUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByOwnerUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserUserApiToken(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $apiToken
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserUserApiTokenList(string $apiToken, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserUserEmail(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param string $email
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserUserEmailList(string $email, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponse $fcmSubscribeServiceResponse
     * @return FcmSubscribeServiceResponse
     */
    public function getByUserUserId(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponse $fcmSubscribeServiceResponse): FcmSubscribeServiceResponse;

    /**
     * @param int $id
     * @param FcmSubscribeRepository $fcmSubscribeRepository
     * @param FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmSubscribeServiceResponseList
     */
   public function getByUserUserIdList(int $id, FcmSubscribeRepository $fcmSubscribeRepository, FcmSubscribeServiceResponseList $fcmSubscribeServiceResponseList, string $q = null, int $length = 12): FcmSubscribeServiceResponseList;

}
