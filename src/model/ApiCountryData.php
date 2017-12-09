<?php


namespace App\Model;
use Slim\Http\Response;


class ApiCountryData extends Api {
	public function call_api_method( string $method_name ): Response {
		// TODO: Implement call_api_method() method.

		$this->response = $this->response->withJson(['Message' => 'Successfully called an ApiCountryData method ' . $method_name], 200);
		return $this->response;
	}
}