<?php


namespace WebAppId\Fcm\Services\Params;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribeParam
 * @package WebAppId\Fcm\Services\Params
 */
class FcmSubscribeParam
{
    /**
     * @var int
     */
    public $owner_id;
    /**
     * @var int
     */
    public $fcm_project_id;
    /**
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $active;
    /**
     * @var string
     */
    public $agent;
    /**
     * @var int
     */
    public $user_id;
    
    
    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }
    
    /**
     * @param int $owner_id
     */
    public function setOwnerId(int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }
    
    /**
     * @return int
     */
    public function getFcmProjectId(): int
    {
        return $this->fcm_project_id;
    }
    
    /**
     * @param int $fcm_project_id
     */
    public function setFcmProjectId(int $fcm_project_id): void
    {
        $this->fcm_project_id = $fcm_project_id;
    }
    
    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
    
    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->active;
    }
    
    /**
     * @param string $active
     */
    public function setActive(string $active): void
    {
        $this->active = $active;
    }
    
    /**
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }
    
    /**
     * @param string $agent
     */
    public function setAgent(string $agent): void
    {
        $this->agent = $agent;
    }
    
    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
    
    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}