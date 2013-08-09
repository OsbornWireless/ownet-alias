<?php namespace Osbornwireless\Alias;

use Illuminate\Foundation\AliasLoader,
    Illuminate\Support\ServiceProvider,
    Illuminate\Support\Facades\App;

class AliasServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('osbornwireless/alias');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->booting(function(){
                $loader = AliasLoader::getInstance();
                $loader->alias('Alias', 'Osbornwireless\Alias\Facades\Alias');
            });

        $this->app->singleton('Alias', function(){
                return new Alias;
            });

        $this->app['alias'] = $this->app->share( function($app) { return App::make('Alias'); });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('alias');
	}

}