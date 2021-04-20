<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use WebAppId\Fcm\Repositories\Contracts\NotificationRepositoryContract;
use WebAppId\Fcm\Repositories\NotificationRepositoryTrait;

/**
 * @author: 
 * Date: 08:09:30
 * Time: 2021/04/20
 * Class NotificationRepository
 * @package WebAppId\Fcm\Repositories
 */
class NotificationRepository implements NotificationRepositoryContract
{
    use NotificationRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
