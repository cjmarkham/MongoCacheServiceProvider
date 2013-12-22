<?php

namespace MongoCache;

use Silex\Application;
use Silex\ServiceProviderInterface;

class MongoCacheServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['mongocache'] = $app->share(function() use ($app) {
			return new MongoCache();
		});
	}

	public function boot(Application $app) {}
}