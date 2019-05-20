<?php

namespace WebAppId\Fcm\Commands;

use Illuminate\Console\Command;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class SeedCommand
 * @package WebAppId\Fcm\Commands
 */
class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webappid:content:seed';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed database';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Artisan::call('db:seed', ['--class' => 'WebAppId\Fcm\Seeds\DatabaseSeeder']);
        //$this->info('Seeded: WebAppId\Fcm\Seeds\ContentSeeder');
    }
}