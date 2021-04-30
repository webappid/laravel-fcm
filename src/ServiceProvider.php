<?php

namespace WebAppId\Fcm;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class ServiceProvider
 * @package WebAppId\Fcm
 */
class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang/', 'fcm');
        $this->loadViewsFrom(__DIR__ . '/resources/views/fcm', 'fcm');
    }
}
