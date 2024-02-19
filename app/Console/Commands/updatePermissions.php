<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class updatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-permissions';

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
        
        // // Get all routes from the route collection
        $routes = Route::getRoutes();
        // // Initialize an array to store the URLs
        $urls = [];
        // // Iterate over each route
        foreach ($routes as $route) {
            // Get the route name
            $name = $route->getName();
            // Check if the route has a name and add it to the array
            if ($name !== null && !Str::contains($name, 'passport') &&  !Str::contains($name, 'sanctum') && !Str::contains($name, 'ignition')) {
                $urls[] = $name;
            }
        }

        foreach ($urls as $key => $value) {
            $Permission = Permission::where('name' ,$value)->first();
            if (!$Permission) {
                Permission::create(['name' =>$value]);
            }
        }
        
    }
}
