<?php


namespace WebAppId\Fcm\Repositories;


use Illuminate\Database\QueryException;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\Contracts\FcmProjectRepositoryContract;
use WebAppId\Fcm\Services\Params\ProjectParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProjectRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmProjectRepository implements FcmProjectRepositoryContract
{
    
    /**
     * @param ProjectParam $projectParam
     * @param FcmProject $fcmProject
     * @return FcmProject|null
     */
    public function store(ProjectParam $projectParam, FcmProject $fcmProject): ?FcmProject
    {
        try {
            $fcmProject->name = $projectParam->getName();
            $fcmProject->server_key = $projectParam->getServerKey();
            $fcmProject->user_id = $projectParam->getUserId();
            $fcmProject->save();
            return $fcmProject;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
}