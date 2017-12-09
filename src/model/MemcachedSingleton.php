<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/9/2017
 * Time: 1:37 PM
 */

namespace App\Model;


class MemcachedSingleton {

	// static instance
	/**
	 * @var \Memcached
	 */
	private static $memcached;
	// end static instance

	// public methods

	// end public methods

	// protected methods
	/**
	 * MemcachedSingleton constructor.
	 *
	 * @param MemcachedServer[] $memcached_servers
	 */
	protected function __construct(array $memcached_servers) {

	}
	// end protected methods

	// private methods
	private function __clone() {
	}


	private function __wakeup() {
	}
	// end private methods

	// public static methods
	/**
	 * @param MemcachedServer[] $memcached_servers
	 *
	 * @return \Memcached
	 */
	public static function get_instance(array $memcached_servers): \Memcached {
		if (empty(self::$memcached))
		{
			self::$memcached = new \Memcached();
			$usable_arr = [];
			foreach ($memcached_servers as $server)
			{
				$usable_arr[] = $server->to_array();
			}
			self::$memcached->addServers($usable_arr);
		}


		return self::$memcached;
	}
	// end public static methods


}