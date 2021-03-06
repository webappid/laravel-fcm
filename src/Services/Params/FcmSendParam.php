<?php
/**
 * Author: galih
 * Date: 2019-05-20
 * Time: 09:13
 */

namespace WebAppId\Fcm\Services\Params;


class FcmSendParam
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $body;
    /**
     * @var string
     */
    public $icon;
    /**
     * @var string
     */
    public $url_action;
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
    
    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    
    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
    
    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }
    
    /**
     * @return string
     */
    public function getUrlAction(): string
    {
        return $this->url_action;
    }
    
    /**
     * @param string $url_action
     */
    public function setUrlAction(string $url_action): void
    {
        $this->url_action = $url_action;
    }
}