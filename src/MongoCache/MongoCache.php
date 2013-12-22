<?php

namespace MongoCache;

use Silex\Application;

class MongoCache
{
	public $collection = null;

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
}