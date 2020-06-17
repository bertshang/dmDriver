<?php

namespace Bertshang\Dameng;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Bertshang\Dameng\Connectors\DmConnector as Connector;

class DmServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot Oci8 Provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/dm.php' => config_path('dm.php'),
        ], 'dm');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists(config_path('dm.php'))) {
            $this->mergeConfigFrom(config_path('dm.php'), 'database.connections');
        } else {
            $this->mergeConfigFrom(__DIR__ . '/../config/dm.php', 'database.connections');
        }

        Connection::resolverFor('dm', function ($connection, $database, $prefix, $config) {
            $connector = new Connector();
            $connection = $connector->connect($config);
            $db = new DmConnection($connection, $database, $prefix, $config);
            return $db;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [];
    }
}
