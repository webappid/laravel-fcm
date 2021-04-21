<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Services\Contracts;

use WebAppId\Fcm\Repositories\NotificationRepository;
use WebAppId\Fcm\Repositories\Requests\NotificationRepositoryRequest;
use WebAppId\Fcm\Services\Requests\NotificationServiceRequest;
use WebAppId\Fcm\Services\Responses\NotificationServiceResponse;
use WebAppId\Fcm\Services\Responses\NotificationServiceResponseList;

/**
 * @author: 
 * Date: 08:09:35
 * Time: 2021/04/20
 * Class NotificationServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface NotificationServiceContract
{
    /**
     * @param NotificationServiceRequest $notificationServiceRequest
     * @param NotificationRepositoryRequest $notificationRepositoryRequest
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function store(NotificationServiceRequest $notificationServiceRequest, NotificationRepositoryRequest $notificationRepositoryRequest, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $code
     * @param NotificationServiceRequest $notificationServiceRequest
     * @param NotificationRepositoryRequest $notificationRepositoryRequest
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function update(string $code, NotificationServiceRequest $notificationServiceRequest, NotificationRepositoryRequest $notificationRepositoryRequest, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $code
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse $notificationServiceResponse
     */
    public function delete(string $code, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string|null $q
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param int $length
     * @return NotificationServiceResponseList
     */
    public function get(NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList,int $length = 12, string $q = null): NotificationServiceResponseList;

    /**
     * @param string|null $q
     * @param NotificationRepository $notificationRepository
     * @return int
     */
    public function getCount(NotificationRepository $notificationRepository, string $q = null):int;

    /**
     * @param string $code
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByCode(string $code, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $code
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByCodeList(string $code, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getById(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param string $apiToken
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserApiToken(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $apiToken
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserApiTokenList(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param string $email
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserEmail(string $email, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $email
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserEmailList(string $email, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserId(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param string $apiToken
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserUserApiToken(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $apiToken
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserUserApiTokenList(string $apiToken, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param string $email
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserUserEmail(string $email, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param string $email
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserUserEmailList(string $email, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponse $notificationServiceResponse
     * @return NotificationServiceResponse
     */
    public function getByUserUserId(int $id, NotificationRepository $notificationRepository, NotificationServiceResponse $notificationServiceResponse): NotificationServiceResponse;

    /**
     * @param int $id
     * @param NotificationRepository $notificationRepository
     * @param NotificationServiceResponseList $notificationServiceResponseList
     * @param string|null $q
     * @param int $length
     * @return NotificationServiceResponseList
     */
   public function getByUserUserIdList(int $id, NotificationRepository $notificationRepository, NotificationServiceResponseList $notificationServiceResponseList, string $q = null, int $length = 12): NotificationServiceResponseList;

}
