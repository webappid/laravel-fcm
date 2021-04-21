<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmLog;
use WebAppId\Fcm\Repositories\Requests\FcmLogRepositoryRequest;

/**
 * @author: 
 * Date: 05:49:20
 * Time: 2021/04/19
 * Class FcmLogRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmLogRepositoryContract
{
    /**
     * @param FcmLogRepositoryRequest $fcmLogRepositoryRequest
     * @param FcmLog $fcmLog
     * @return FcmLog|null
     */
    public function store(FcmLogRepositoryRequest $fcmLogRepositoryRequest, FcmLog $fcmLog): ?FcmLog;

    /**
     * @param int $id
     * @param FcmLogRepositoryRequest $fcmLogRepositoryRequest
     * @param FcmLog $fcmLog
     * @return FcmLog|null
     */
    public function update(int $id, FcmLogRepositoryRequest $fcmLogRepositoryRequest, FcmLog $fcmLog): ?FcmLog;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @return bool
     */
    public function delete(int $id, FcmLog $fcmLog): bool;

    /**
     * @param FcmLog $fcmLog
     * @param int $length
     * @param string|null $q
     * @return LengthAwarePaginator
     */
    public function get(FcmLog $fcmLog, int $length = 12, string $q = null): LengthAwarePaginator;

    /**
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @return int
     */
    public function getCount(FcmLog $fcmLog, string $q = null): int;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getById(int $id, FcmLog $fcmLog):? FcmLog;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $token
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getByFcmSubscribeToken(string $token, FcmLog $fcmLog):? FcmLog;

    /**
     * @param string $token
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByFcmSubscribeTokenList(string $token, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getByFcmSubscribeId(int $id, FcmLog $fcmLog):? FcmLog;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByFcmSubscribeIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getByUserApiToken(string $apiToken, FcmLog $fcmLog):? FcmLog;

    /**
     * @param string $apiToken
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserApiTokenList(string $apiToken, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getByUserEmail(string $email, FcmLog $fcmLog):? FcmLog;

    /**
     * @param string $email
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserEmailList(string $email, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @return FcmLog
     */
    public function getByUserId(int $id, FcmLog $fcmLog):? FcmLog;

    /**
     * @param int $id
     * @param FcmLog $fcmLog
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator;

}
