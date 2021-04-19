<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Contracts;

use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Repositories\Requests\FcmProjectRepositoryRequest;
use WebAppId\Fcm\Services\Requests\FcmProjectServiceRequest;
use WebAppId\Fcm\Services\Responses\FcmProjectServiceResponse;
use WebAppId\Fcm\Services\Responses\FcmProjectServiceResponseList;

/**
 * @author: 
 * Date: 02:03:39
 * Time: 2021/04/18
 * Class FcmProjectServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface FcmProjectServiceContract
{
    /**
     * @param FcmProjectServiceRequest $fcmProjectServiceRequest
     * @param FcmProjectRepositoryRequest $fcmProjectRepositoryRequest
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function store(FcmProjectServiceRequest $fcmProjectServiceRequest, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param int $id
     * @param FcmProjectServiceRequest $fcmProjectServiceRequest
     * @param FcmProjectRepositoryRequest $fcmProjectRepositoryRequest
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function update(int $id, FcmProjectServiceRequest $fcmProjectServiceRequest, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param int $id
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse $fcmProjectServiceResponse
     */
    public function delete(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param string|null $q
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @param int $length
     * @return FcmProjectServiceResponseList
     */
    public function get(FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList,int $length = 12, string $q = null): FcmProjectServiceResponseList;

    /**
     * @param string|null $q
     * @param FcmProjectRepository $fcmProjectRepository
     * @return int
     */
    public function getCount(FcmProjectRepository $fcmProjectRepository, string $q = null):int;

    /**
     * @param int $id
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function getById(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param int $id
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmProjectServiceResponseList
     */
   public function getByIdList(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null, int $length = 12): FcmProjectServiceResponseList;

    /**
     * @param string $apiToken
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function getByUserApiToken(string $apiToken, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param string $apiToken
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmProjectServiceResponseList
     */
   public function getByUserApiTokenList(string $apiToken, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null, int $length = 12): FcmProjectServiceResponseList;

    /**
     * @param string $email
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function getByUserEmail(string $email, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param string $email
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmProjectServiceResponseList
     */
   public function getByUserEmailList(string $email, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null, int $length = 12): FcmProjectServiceResponseList;

    /**
     * @param int $id
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponse $fcmProjectServiceResponse
     * @return FcmProjectServiceResponse
     */
    public function getByUserId(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponse $fcmProjectServiceResponse): FcmProjectServiceResponse;

    /**
     * @param int $id
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectServiceResponseList $fcmProjectServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return FcmProjectServiceResponseList
     */
   public function getByUserIdList(int $id, FcmProjectRepository $fcmProjectRepository, FcmProjectServiceResponseList $fcmProjectServiceResponseList, string $q = null, int $length = 12): FcmProjectServiceResponseList;

}
