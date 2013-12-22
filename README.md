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

	$app['mongocache']->set(\MongoCollection $collection, $key, $data);
	$app['mongocache']->get(\MongoCollection $collection, $key, \Closure $function);
	$app['mongocache']->delete(\MongoCollection $collection, $key);
	$app['mongocache']->delete_group(\MongoCollection $collection, $group);