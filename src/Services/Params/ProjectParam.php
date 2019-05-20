<?php


namespace WebAppId\Fcm\Services\Params;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class ProjectParam
 * @package WebAppId\Fcm\Services\Params
 */
class ProjectParam
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $server_key;
    
    /**
     * @var integer
     */
    private $user_id;
    
    
    
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getServerKey(): string
    {
        return $this->server_key;
    }
    
    /**
     * @param string $server_key
     */
    public function setServerKey(string $server_key): void
    {
        $this->server_key = $server_key;
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