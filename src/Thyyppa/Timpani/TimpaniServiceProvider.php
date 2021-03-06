<?php

/**
 * Timpani Service Provider
 * @author Travis Hyyppä <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use Config;
use Route;


/**
 * Timpani Service Provider
 */
class TimpaniServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;



	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $this->app->bindShared( 'timpani', function()
        {

            return $this->app->make('Thyyppa\Timpani\FacadeHandler');

        });

    }



    /**
     * Boot ServiceProvider
     *
     * @return  void
     */
	public function boot()
	{

		$this->package('thyyppa/timpani');


		// If the config doesn't contain and alias for Timpani, create one
		if ( ! in_array('Thyyppa\Timpani\Timpani', Config::get('app.aliases') ) )

		    AliasLoader::getInstance()->alias( 'Timpani', 'Thyyppa\Timpani\Timpani' );


		// If the route doesn't exist, create it
		if ( ! Route::has('timpani') )

			require_once __DIR__ . '/../../routes.php';


	}



	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{

		return [ 'timpani' ];

	}


}
