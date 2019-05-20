<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 12:58
 */

namespace WebAppId\Fcm\Responses;


use WebAppId\DDD\Responses\AbstractResponse;

class FcmResponse extends AbstractResponse
{
    /**
     * @var object
     */
    private $result;
    
    /**
     * @return object
     */
    public function getResult(): object
    {
        return $this->result;
    }
    
    /**
     * @param object $result
     */
    public function setResult(object $result): void
    {
        $this->result = $result;
    }
}