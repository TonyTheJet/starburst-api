<?php
namespace App\Model;


class MemcachedServer {

	/**
	 * @var int
	 */
	private $port;

	/**
	 * @var string
	 */
	private $server;

	/**
	 * @var int
	 */
	private $weight;

	// getters
	public function get_port(): int { return $this->port; }
	public function get_server(): string { return $this->server; }
	public function get_weight(): int { return $this->weight; }
	// end getters

	public function __construct(string $server, int $port, int $weight = 0) {
		$this->server = $server;
		$this->port = $port;
		$this->weight = $weight;
	}

}