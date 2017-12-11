<?php

namespace App\Model\Interfaces;
use \MongoDB\Client;

interface DBMappable {

	public function delete_from_db(Client $db): bool;
	public function insert_into_db(Client $db): bool;

	/**
	 * inserts if not exist, or updates if exist
	 * @param Client $db
	 *
	 * @return bool
	 */
	public function save_to_db(Client $db): bool;
	public function update_in_db(Client $db): bool;
}