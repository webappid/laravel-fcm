<?php

namespace WebAppId\Fcm;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use WebAppId\Fcm\Commands\SeedCommand;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class ServiceProvider
 * @package WebAppId\Fcm
 */
class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->commands(SeedCommand::class);
    }
    public function boot()
    {
        if ($this->isLaravel53AndUp()) {
            $this->loadMigrationsFrom(__DIR__.'/migrations');
        } else {
            $this->publishes([
                __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
            ], 'migrations');
        }
    }
    protected function isLaravel53AndUp()
    {
        return version_compare($this->app->version(), '5.3.0', '>=');
    }
}