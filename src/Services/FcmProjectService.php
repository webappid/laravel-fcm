<?php


namespace WebAppId\Fcm\Services;


use WebAppId\DDD\Services\BaseService;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Responses\FcmProjectResponse;
use WebAppId\Fcm\Services\Contracts\FmProjectServiceContract;
use WebAppId\Fcm\Services\Params\ProjectParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProjectService
 * @package WebAppId\Fcm\Services
 */
class FcmProjectService extends BaseService implements FmProjectServiceContract
{
    
    /**
     * @param ProjectParam $projectParam
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectResponse $fcmProjectResponse
     * @return FcmProjectResponse
     */
    public function store(ProjectParam $projectParam, FcmProjectRepository $fcmProjectRepository, FcmProjectResponse $fcmProjectResponse): FcmProjectResponse
    {
        $result = $this->getContainer()->call([$fcmProjectRepository, 'store'], ['projectParam' => $projectParam]);
        if ($result != null) {
            $fcmProjectResponse->setStatus(true);
            $fcmProjectResponse->setMessage('Save Data Fcm Project Success');
            $fcmProjectResponse->setFcmProject($result);
        } else {
            $fcmProjectResponse->setStatus(false);
            $fcmProjectResponse->setMessage('Save Data Fcm Project Failed');
        }
        return $fcmProjectResponse;
    }
}