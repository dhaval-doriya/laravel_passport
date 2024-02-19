<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class customMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom_migrate {fnc?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arguments = $this->arguments('fnc');
        $rollabck = ($arguments['fnc'] == 'rollback') ? true : false;

        $oldDB = Config::get('database.default');
        $databases = explode(',', env('COMPANY_DB_DATABASES'));
        
        foreach ($databases as $key => $value) {
            Config::set('database.default', $value);
            $this->runMigrations($value, $rollabck);
        }
        
        Config::set('database.default', $oldDB);
        $this->info('migration action sucessfully completed');
    }

    function runMigrations($databaseConnection, $rollabck)
    {
        $this->checkMigrationTable();
        if (!$rollabck) {
            Artisan::call('migrate', [
                '--database' => $databaseConnection,
            ]);
        } else {
            Artisan::call('migrate:rollback', [
                '--database' => $databaseConnection,
            ]);
        }

        $output = Artisan::output();
        $this->info($output);
    }

    function checkMigrationTable()
    {
        if (!Schema::hasTable('migrations')) {
            Schema::create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migration');
                $table->integer('batch');
                $table->timestamps();
            });
        }
    }
}
