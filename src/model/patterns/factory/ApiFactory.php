<?php
	namespace App\Model\Patterns\Factory;
	use \Slim\Exception\NotFoundException;
	use \Slim\Http\Request;
	use \Slim\Http\Response;
	use \App\Model\Api;
	use \App\Model\ApiCountryData;
	use \App\Model\ApiSalesTax;
	class ApiFactory {

		// private constants
		private const API_KEY_COUNTRY_DATA = 'country-data';
		private const API_KEY_SALES_TAX = 'sales-tax';
		// end private constants

		/**
		 * @param Request $request
		 * @param Response $response
		 * @param array $args
		 * @param \Memcached $cache
		 * @param string $api_name
		 *
		 * @return Api
		 * @throws NotFoundException
		 */
		public static function create(
			Request $request,
			Response $response,
			array $args,
			\Memcached $cache,
			string $api_name
		): Api {
			switch (strtolower($api_name))
			{
				case self::API_KEY_COUNTRY_DATA:
					return new ApiCountryData($request, $response, $args, $cache);
				case self::API_KEY_SALES_TAX:
					return new ApiSalesTax($request, $response, $args, $cache);
				default:
					throw new NotFoundException($request, $response);
			}
		}

	}