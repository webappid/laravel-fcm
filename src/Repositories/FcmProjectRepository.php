<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use WebAppId\Fcm\Repositories\FcmProjectRepositoryTrait;

/**
 * @author: 
 * Date: 02:03:24
 * Time: 2021/04/18
 * Class FcmProjectRepository
 * @package WebAppId\Fcm\Repositories
 */
class FcmProjectRepository
{
    use FcmProjectRepositoryTrait;

    /**
     * @var array
     */
    protected $joinTable = [];

    public function __construct(){
        $this->init();
    }
}
