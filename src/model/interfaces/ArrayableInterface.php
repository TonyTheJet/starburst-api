<?php

namespace App\Model\interfaces;


interface ArrayableInterface {
	public function from_array(array $data);
	public function to_array(): array;
}