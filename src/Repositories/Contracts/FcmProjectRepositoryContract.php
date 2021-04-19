<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\Requests\FcmProjectRepositoryRequest;

/**
 * @author: 
 * Date: 02:03:20
 * Time: 2021/04/18
 * Class FcmProjectRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmProjectRepositoryContract
{
    /**
     * @param FcmProjectRepositoryRequest $fcmProjectRepositoryRequest
     * @param FcmProject $fcmProject
     * @return FcmProject|null
     */
    public function store(FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProject $fcmProject): ?FcmProject;

    /**
     * @param int $id
     * @param FcmProjectRepositoryRequest $fcmProjectRepositoryRequest
     * @param FcmProject $fcmProject
     * @return FcmProject|null
     */
    public function update(int $id, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProject $fcmProject): ?FcmProject;

    /**
     * @param int $id
     * @param FcmProject $fcmProject
     * @return bool
     */
    public function delete(int $id, FcmProject $fcmProject): bool;

    /**
     * @param FcmProject $fcmProject
     * @param int $length
     * @param string|null $q
     * @return LengthAwarePaginator
     */
    public function get(FcmProject $fcmProject, int $length = 12, string $q = null): LengthAwarePaginator;

    /**
     * @param FcmProject $fcmProject
     * @param string|null $q
     * @return int
     */
    public function getCount(FcmProject $fcmProject, string $q = null): int;

    /**
     * @param int $id
     * @param FcmProject $fcmProject
     * @return FcmProject
     */
    public function getById(int $id, FcmProject $fcmProject):? FcmProject;

    /**
     * @param int $id
     * @param FcmProject $fcmProject
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByIdList(int $id, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $apiToken
     * @param FcmProject $fcmProject
     * @return FcmProject
     */
    public function getByUserApiToken(string $apiToken, FcmProject $fcmProject):? FcmProject;

    /**
     * @param string $apiToken
     * @param FcmProject $fcmProject
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserApiTokenList(string $apiToken, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param string $email
     * @param FcmProject $fcmProject
     * @return FcmProject
     */
    public function getByUserEmail(string $email, FcmProject $fcmProject):? FcmProject;

    /**
     * @param string $email
     * @param FcmProject $fcmProject
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserEmailList(string $email, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator;

    /**
     * @param int $id
     * @param FcmProject $fcmProject
     * @return FcmProject
     */
    public function getByUserId(int $id, FcmProject $fcmProject):? FcmProject;

    /**
     * @param int $id
     * @param FcmProject $fcmProject
     * @param string|null $q
     * @param int $length
     * @return LengthAwarePaginator
     */
    public function getByUserIdList(int $id, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator;

}
