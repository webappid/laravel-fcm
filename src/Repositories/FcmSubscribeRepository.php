<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use WebAppId\Fcm\Repositories\FcmSubscribeRepositoryTrait;

/**
 * @author: 
 * Date: 04:25:46
 * Time: 2021/04/18
 * Class FcmSubscribeRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmSubscribeRepository
{
    use FcmSubscribeRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
