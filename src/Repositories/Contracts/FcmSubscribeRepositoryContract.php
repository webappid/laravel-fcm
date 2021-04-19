<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Repositories\Requests\FcmSubscribeRepositoryRequest;

/**
 * @author: 
 * Date: 04:25:40
 * Time: 2021/04/18
 * Class FcmSubscribeRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmSubscribeRepositoryContract
{
    /**
     * @param FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe|null
     */
    public function store(FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribe $fcmSubscribe): ?FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe|null
     */
    public function update(int $id, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribe $fcmSubscribe): ?FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return bool
     */
    public function delete(int $id, FcmSubscribe $fcmSubscribe): bool;

    /**
     * @param FcmSubscribe $fcmSubscribe
     * @param int $length
     * @param string|null $q
     * @return LengthAwarePaginator
     */
    public function get(FcmSubscribe $fcmSubscribe, int $length = 12, string $q = null): LengthAwarePaginator;

    /**
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @return int
     */
    public function getCount(FcmSubscribe $fcmSubscribe, string $q = null): int;

    /**
     * @param string $token
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByToken(string $token, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $token
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByTokenList(string $token, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getById(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByFcmProjectId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByFcmProjectIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByOwnerUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByOwnerUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByOwnerUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByOwnerUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByOwnerUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByOwnerUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $apiToken
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param string $email
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @return FcmSubscribe
     */
    public function getByUserUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe;

    /**
     * @param int $id
     * @param FcmSubscribe $fcmSubscribe
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator;

}
