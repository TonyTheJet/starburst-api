<?php
	namespace App\Model;


	use Slim\Http\Response;

	class ApiSalesTax extends Api{

		public function call_api_method( string $method_name ): Response {
			// TODO: Implement call_api_method() method.

			$this->response = $this->response->withJson(['Message' => 'Successfully called an ApiSalesTax method and stuff'], 200);
			return $this->response;
		}
	}