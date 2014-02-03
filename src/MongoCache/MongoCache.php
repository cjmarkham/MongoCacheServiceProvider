<?php

namespace MongoCache;

use Silex\Application;

class MongoCache
{
	public $collection = null;
	public $app;

	public function setCollection ($database, $name)
	{
		return $this->app['mongo'][$database]->selectCollection($database, $name);
	}
	
	public function get ($key, \Closure $function = null)
	{
		$result = $this->collection->findOne(array(
			'key' => $key
		));

		if (empty($result) && $function instanceof \Closure)
		{
			$result = $function();
			$this->set($key, $result);
		}

		return $result;
	}

	public function set ($key, $data)
	{
		return $this->collection->insert(array(
			'key' => $key,
			'data' => $data['data']
		));
	}

	public function append ($key, $data, \Closure $function = null)
	{
		$result = $this->collection->findOne(array(
			'key' => $key
		));

		if (!$result['data'])
		{
			$result['data'] = array();
		}

		$result['data'][] = $data;
		$this->collection->update(array(
			'key' => $key
		), array(
			'key' => $key,
			'data' => $result['data']
		), array(
			'upsert' => true
		));

		return $result;
	}

	public function delete ($key)
	{
		return $this->collection->remove(array(
			'key' => $key
		));
	}

	public function delete_group ($group)
	{
		return $this->collection->remove(array(
			'key' => array(
				'$regex' => $group . '\..*'
			) 
		));
	}

	public function flush (Application $app, $connection = 'default', $database)
	{
		$database = $app['mongo'][$connection]->selectDB($database);
		return $database->drop();
	}
}