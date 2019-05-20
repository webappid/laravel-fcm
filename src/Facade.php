<?php


namespace WebAppId\Fcm;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class Facade
 * @package WebAppId\Fcm
 */
class Facade extends BaseFacade
{
    protected static function getFacadeAccessor() {
        return 'fcm';
    }
}