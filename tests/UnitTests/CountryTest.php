<?php
/**
 * Created by PhpStorm.
 * User: bulga
 * Date: 12/10/2017
 * Time: 1:46 PM
 */

namespace Tests\UnitTests;
use \App\Model\Country;
use \Exception;
require_once __DIR__ . '/../../vendor/autoload.php';

class CountryTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @dataProvider country_data_provider
	 * @param Country $country
	 */
	public function test_to_array_from_array(Country $country){
		$arr = $country->to_array();
		$country2 = new Country();
		$country2->from_array($arr);


		$this->assertEquals($country->get_alpha2_code(), $country2->get_alpha2_code());
		$this->assertEquals($country->get_alpha3_code(), $country2->get_alpha3_code());
		$this->assertEquals($country->get_alt_spellings(), $country2->get_alt_spellings());
		$this->assertEquals($country->get_area(), $country2->get_area());
		$this->assertEquals($country->get_borders(), $country2->get_borders());
		$this->assertEquals($country->get_calling_codes(), $country2->get_calling_codes());
		$this->assertEquals($country->get_capital(), $country2->get_capital());
		$this->assertEquals($country->get_cioc(), $country2->get_cioc());
		$this->assertEquals($country->get_currencies(), $country2->get_currencies());
		$this->assertEquals($country->get_demonym(), $country2->get_demonym());
		$this->assertEquals($country->get_flag(), $country2->get_flag());
		$this->assertEquals($country->get_gini(), $country2->get_gini());
		$this->assertEquals($country->get_languages(), $country2->get_languages());
		$this->assertEquals($country->get_lat_lng(), $country2->get_lat_lng());
		$this->assertEquals($country->get_name(), $country2->get_name());
		$this->assertEquals($country->get_native_name(), $country2->get_native_name());
		$this->assertEquals($country->get_numeric_code(), $country2->get_numeric_code());
		$this->assertEquals($country->get_population(), $country2->get_population());
		$this->assertEquals($country->get_region(), $country2->get_region());
		$this->assertEquals($country->get_regional_blocs(), $country2->get_regional_blocs());
		$this->assertEquals($country->get_sub_region(), $country2->get_sub_region());
		$this->assertEquals($country->get_timezones(), $country2->get_timezones());
		$this->assertEquals($country->get_top_level_domains(), $country2->get_top_level_domains());
		$this->assertEquals($country->get_translations(), $country2->get_translations());
	}

	// data providers
	public function country_data_provider() {
		$country = new Country();
		$country->set_alpha2_code('TA');
		$country->set_alpha3_code('TMA');
		$country->set_alt_spellings([
			'Anthony Michael Anderson',
			'Tony Michael Anderson'
		]);
		$country->set_area((float) rand(999999, 99999999));
		$country->set_borders([
			'XXX',
			'YYY',
			'ZZZ'
		]);
		$country->set_calling_codes(['999', '111']);
		$country->set_capital('Tonytropolis');
		$country->set_cioc('BUR');
		$country->set_currencies([
			'BGN',
			'USD'
		]);
		$country->set_demonym('Tonites');
		$country->set_flag('http://www.nba.com');
		$country->set_gini(rand(999, 9999) / rand(5, 12));
		$country->set_languages([
			'bg',
			'en',
			'es'
		]);
		try {
			$country->set_lat_lng([
				rand(-90, 90),
				rand(-180, 180)
			]);
		}
		catch (Exception $e)
		{

		}
		$country->set_name('Tonylandia');
		$country->set_native_name('Tonylandia');
		$country->set_numeric_code('999');
		$country->set_population(rand(1, 20));
		$country->set_region('Tonythican Peninsula');
		$country->set_regional_blocs([
			'Tonythicalia'
		]);
		$country->set_sub_region('Tonythican Peninsula South');
		$country->set_timezones([
			"UTC-08:00",
			"UTC-07:00",
			"UTC-06:00",
			"UTC-05:00",
			"UTC-04:00",
			"UTC-03:30"
		]);
		$country->set_top_level_domains([
			'.ta',
			'.aa'
		]);
		try {
			$country->set_translations([
				'bg' => 'Тониландия'
			]);
		}
		catch (Exception $e)
		{

		}

		return [
			[
				$country
			]
		];
	}
	// end data providers

}