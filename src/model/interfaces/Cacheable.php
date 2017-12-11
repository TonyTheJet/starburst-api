<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/10/2017
 * Time: 9:14 PM
 */

namespace App\Model\Interfaces;
use \Memcached;

interface Cacheable {
	public function cache(Memcached $cache, int $timeout_seconds): void;
	public function flush_cache(Memcached $cache): bool;
	public function from_cache(Memcached $cache): bool;
}