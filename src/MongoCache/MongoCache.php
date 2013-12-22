<?php

namespace MongoCache;

use Silex\Application;

class MongoCache
{
	public function get (MongoCollection $collection, $key, \Closure $function = null)
	{
		$result = $collection->findOne(array(
			'key' => $key
		));

		if (empty($result) && $function instanceof \Closure)
		{
			$result = $function();
			$this->set($collection, $key, $result);
		}

		return $result;
	}

	public function set ($collection, $key, $data)
	{
		return $collection->insert(array(
			'key' => $key,
			'data' => $data['data']
		));
	}

	public function delete (MongoCollection $collection, $key)
	{
		return $collection->remove(array(
			'key' => $key
		));
	}

	public function delete_group (MongoCollection $collection, $group)
	{
		return $collection->remove(array(
			'key' => array(
				'$regex' => $group . '\..*'
			) 
		));
	}
}