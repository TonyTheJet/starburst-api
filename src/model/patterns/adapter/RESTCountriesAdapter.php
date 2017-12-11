<?php

namespace App\Model\Patterns\Adapter;

use \App\Model\Country;
use \Memcached;
use \MongoDB\Client;

class RESTCountriesAdapter {

	// private constants
	private const CACHE_DURATION_SECONDS = 604800; // 1 week
	private const REST_COUNTRIES_ALL_URL = 'https://restcountries.eu/rest/v2/all';
	// end private constants

	// private members
	private $country_json_arr;
	// end private members

	// public functions
	public function __construct(array $country_json_arr) {
		$this->country_json_arr = $country_json_arr;
	}

	/**
	 * @return Country
	 */
	public function adapt_to_country(): Country {
		$data_arr = $this->country_json_arr;
		$data_arr['alt_spellings'] = $this->country_json_arr['altSpellings'];
		$data_arr['alpha2_code'] = $this->country_json_arr['alpha2Code'];
		$data_arr['alpha3_code'] = $this->country_json_arr['alpha3Code'];
		$data_arr['calling_codes'] = $this->country_json_arr['callingCodes'];
		$data_arr['lat_lng'] = $this->country_json_arr['latlng'];
		$data_arr['native_name'] = $this->country_json_arr['nativeName'];
		$data_arr['numeric_code'] = $this->country_json_arr['numericCode'];
		$data_arr['regional_blocs'] = $this->country_json_arr['regionalBlocs'];
		$data_arr['top_level_domains'] = $this->country_json_arr['topLevelDomain'];

		$country = new Country();
		$country->from_array($data_arr);

		return $country;
	}
	// end public functions

	// public static functions
	/**
	 * renews all items
	 * @param Client $mongo_db
	 * @param Memcached $memcached
	 */
	public static function renew_all(Client $mongo_db, Memcached $memcached): void {
		$json = file_get_contents(self::REST_COUNTRIES_ALL_URL);
		if (!empty($json))
		{
			$json_arr = json_decode($json, true);
			foreach ($json_arr as $country_arr)
			{
				$adapter = new RESTCountriesAdapter($country_arr);
				$country = $adapter->adapt_to_country();

				// save country to DB
				$country->save_to_db($mongo_db);

				// save country to cache
				$country->cache($memcached, self::CACHE_DURATION_SECONDS);
			}
		}
	}
	// end public static functions
}