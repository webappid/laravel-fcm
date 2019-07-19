<?php


namespace WebAppId\Fcm\Repositories;


use Exception;
use Illuminate\Database\QueryException;
use WebAppId\DDD\Tools\Lazy;
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
     * @throws Exception
     */
    public function store(ProjectParam $projectParam, FcmProject $fcmProject): ?FcmProject
    {
        try {
            $fcmProject = Lazy::copy($projectParam, $fcmProject);
            $fcmProject->save();
            return $fcmProject;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
}