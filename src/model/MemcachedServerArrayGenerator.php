<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/9/2017
 * Time: 1:59 PM
 */

namespace App\Model;

use \Slim\App;

class MemcachedServerArrayGenerator {
	/**
	 * @param App $app
	 *
	 * @return MemcachedServer[]
	 */
	public static function generate_servers_arr_from_app_settings(App $app): array {
		$servers_arr = [];
		if (!empty($app->getContainer()['cache']) && !empty($app->getContainer()['cache']['servers']))
		{
			$servers_arr = [];
			foreach ($app->getContainer()['cache']['servers'] as $server_data)
			{
				$servers_arr = new MemcachedServer($server_data['server'], $server_data['port'], $server_data['weight']);
			}
		}

		return $servers_arr;
	}
}