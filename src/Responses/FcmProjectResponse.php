<?php


namespace WebAppId\Fcm\Responses;


use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Fcm\Models\FcmProject;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProjectResponse
 * @package WebAppId\Fcm\Responses
 */
class FcmProjectResponse extends AbstractResponse
{
    /**
     * @var FcmProject
     */
    private $fcmProject;
    
    /**
     * @return FcmProject
     */
    public function getFcmProject(): FcmProject
    {
        return $this->fcmProject;
    }
    
    /**
     * @param FcmProject $fcmProject
     */
    public function setFcmProject(FcmProject $fcmProject): void
    {
        $this->fcmProject = $fcmProject;
    }
}