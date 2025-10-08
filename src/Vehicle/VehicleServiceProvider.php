<?php

namespace Axterisko\Vehicle;

use Illuminate\Support\ServiceProvider;

class VehicleServiceProvider extends ServiceProvider
{
    /**
     * Commands
     *
     * @var array
     */
    protected $commands = [
        'Axterisko\Vehicle\Commands\GenerateVehiclesData',
        'Axterisko\Vehicle\Commands\ExportVehiclesData',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Support both Laravel 7.x and earlier (seeds) and Laravel 8+ (seeders)
        $seedersPath = is_dir(database_path('seeders'))
            ? database_path('seeders/VehicleTablesSeeder.php')
            : database_path('seeds/VehicleTablesSeeder.php');

        $this->publishes([
            __DIR__.'/../config/vehicles.php' => config_path('vehicles.php'),
            __DIR__.'/../database/migrations/' => database_path('migrations'),
            __DIR__.'/../database/seeds/VehicleTablesSeeder.php' => $seedersPath
        ], 'laravel-vehicle');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register commands...
        $this->commands($this->commands);
    }
}
