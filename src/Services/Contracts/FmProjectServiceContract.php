<?php


namespace WebAppId\Fcm\Services\Contracts;


use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Responses\FcmProjectResponse;
use WebAppId\Fcm\Services\Params\ProjectParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FmProjectServiceContract
 * @package WebAppId\Fcm\Services\Contracts
 */
interface FmProjectServiceContract
{
    /**
     * @param ProjectParam $projectParam
     * @param FcmProjectRepository $fcmProjectRepository
     * @param FcmProjectResponse $fcmProjectResponse
     * @return FcmProjectResponse
     */
    public function store(ProjectParam $projectParam, FcmProjectRepository $fcmProjectRepository, FcmProjectResponse $fcmProjectResponse): FcmProjectResponse;
}