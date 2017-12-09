<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/9/2017
 * Time: 1:59 PM
 */

namespace App\Model;

use Psr\Container\ContainerExceptionInterface;
use \Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class MemcachedServerArrayGenerator {
	/**
	 * @param ContainerInterface $container
	 *
	 * @return MemcachedServer[]
	 */
	public static function generate_servers_arr_from_app_settings(ContainerInterface $container): array {
		$servers_arr = [];
		try {
			if ( ! empty( $container['settings'] ) && ! empty( $container->get( 'settings' )['cache'] ) ) {
				$servers_arr = [];
				foreach ( $container->get( 'settings' )['cache']['servers'] as $server_data ) {
					$servers_arr[] = new MemcachedServer( $server_data['server'], $server_data['port'], $server_data['weight'] );
				}
			}
		} catch ( NotFoundExceptionInterface $e ) {
		} catch ( ContainerExceptionInterface $e ) {
		}

		return $servers_arr;
	}
}