<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use WebAppId\Fcm\Repositories\FcmLogRepositoryTrait;

/**
 * @author: 
 * Date: 05:49:30
 * Time: 2021/04/19
 * Class FcmLogRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmLogRepository
{
    use FcmLogRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
