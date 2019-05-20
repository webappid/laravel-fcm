<?php


namespace WebAppId\Fcm\Repositories\Contracts;


use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Services\Params\ProjectParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FcmProjectRepositoryContract
 * @package WebAppId\Fcm\Repositories\Contracts
 */
interface FcmProjectRepositoryContract
{
    /**
     * @param ProjectParam $projectParam
     * @param FcmProject $fcmProject
     * @return FcmProject|null
     */
    public function store(ProjectParam $projectParam, FcmProject $fcmProject): ?FcmProject;
}