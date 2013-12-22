MongoCacheServiceProvider
=======================

A mongo cache service for silex

Registering
-----------

In composer.json add this to your dependencies

	"cjmarkham/mongo-cache": "dev-master"

Then to register

	$app->register(new MongoCache\MongoCacheServiceProvider());

Usage
-----

	$app->register(new MongoCache\MongoCacheServiceProvider());

	$app['mongocache']->collection = $collection;

	$app['mongocache']->set($key, $data);
	$app['mongocache']->get($key, \Closure $function);
	$app['mongocache']->delete($key);
	$app['mongocache']->delete_group($group);