<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\Notification;
use WebAppId\Fcm\Repositories\Requests\NotificationRepositoryRequest;

/**
 * @author: 
 * Date: 08:09:08
 * Time: 2021/04/20
 * Class NotificationRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface NotificationRepositoryContract
{
    /**
     * @param NotificationRepositoryRequest $notificationRepositoryRequest
     * @param Notification $notification
     * @return Notification|null
     */
    public function store(NotificationRepositoryRequest $notificationRepositoryRequest, Notification $notification): ?Notification;

    /**
     * @param string $code
     * @param NotificationRepositoryRequest $notificationRepositoryRequest
     * @param Notification $notification
     * @return Notification|null
     */
    public function update(string $code, NotificationRepositoryRequest $notificationRepositoryRequest, Notification $notification): ?Notification;

    /**
     * @param string $code
     * @param Notification $notification
     * @return bool
     */
    public function delete(string $code, Notification $notification): bool;

    /**
     * @param Notification $notification
     * @param int $length
     * @param string|null $q
     * @return LengthAwarePaginator
     */
    public function get(Notification $notification, int $length = 12, string $q = null): LengthAwarePaginator;

    /**
     * @param Notification $notification
     * @param string|null $q
     * @return int
     */
    public function getCount(Notification $notification, string $q = null): int;

    /**
     * @param string $code
     * @param Notification $notification
     * @return Notification
     */
    public function getByCode(string $code, Notification $notification):? Notification;

    /**
     * @param string $code
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByCodeList(string $code, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Notification $notification
     * @return Notification
     */
    public function getById(int $id, Notification $notification):? Notification;

    /**
     * @param int $id
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserApiToken(string $apiToken, Notification $notification):? Notification;

    /**
     * @param string $apiToken
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserApiTokenList(string $apiToken, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserEmail(string $email, Notification $notification):? Notification;

    /**
     * @param string $email
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserEmailList(string $email, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserId(int $id, Notification $notification):? Notification;

    /**
     * @param int $id
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserUserApiToken(string $apiToken, Notification $notification):? Notification;

    /**
     * @param string $apiToken
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserApiTokenList(string $apiToken, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserUserEmail(string $email, Notification $notification):? Notification;

    /**
     * @param string $email
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserEmailList(string $email, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param Notification $notification
     * @return Notification
     */
    public function getByUserUserId(int $id, Notification $notification):? Notification;

    /**
     * @param int $id
     * @param Notification $notification
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator;

}
