<?php
	namespace App\Model;
	use \Slim\Exception\NotFoundException;
	use \Slim\Http\Request;
	use \Slim\Http\Response;
	class ApiFactory {

		// private constants
		private const API_KEY_SALES_TAX = 'sales-tax';
		// end private constants

		public static function create(
			Request $request,
			Response $response,
			array $args,
			string $api_name
		): Api {

			// TODO: implement this method

			switch (strtolower($api_name))
			{
				case self::API_KEY_SALES_TAX:
					return new ApiSalesTax($request, $response, $args);
					break;
				default:
					throw new NotFoundException($request, $response);
			}
		}

	}