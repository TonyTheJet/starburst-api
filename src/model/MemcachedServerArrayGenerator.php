<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/9/2017
 * Time: 1:59 PM
 */

namespace App\Model;

use \Slim\Container;

class MemcachedServerArrayGenerator {
	/**
	 * @param Container $container
	 *
	 * @return MemcachedServer[]
	 */
	public static function generate_servers_arr_from_app_settings(Container $container): array {
		$servers_arr = [];
		if ( !empty($container['cache']) && !empty($container['cache']['servers']))
		{
			$servers_arr = [];
			foreach ($container['cache']['servers'] as $server_data)
			{
				$servers_arr = new MemcachedServer($server_data['server'], $server_data['port'], $server_data['weight']);
			}
		}

		return $servers_arr;
	}
}