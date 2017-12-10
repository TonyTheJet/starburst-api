<?php

namespace App\Model;
use \Exception;

class Country implements Interfaces\ArrayableInterface {

	// private members
	/**
	 * @var string
	 */
	private $alpha2_code;
	/**
	 * @var string
	 */
	private $alpha3_code;
	/**
	 * @var string[]
	 */
	private $alt_spellings;
	/**
	 * @var float
	 */
	private $area;
	/**
	 * @var string[]
	 */
	private $borders;
	/**
	 * @var string[]
	 */
	private $calling_codes;
	/**
	 * @var string
	 */
	private $capital;
	/**
	 * @var string
	 */
	private $cioc;
	/**
	 * @var array[]
	 */
	private $currencies;
	/**
	 * @var string
	 */
	private $demonym;
	/**
	 * @var string
	 */
	private $flag;
	/**
	 * @var float
	 */
	private $gini;
	/**
	 * @var array[]
	 */
	private $languages;
	/**
	 * @var float[]
	 */
	private $lat_lng;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $native_name;
	/**
	 * @var string
	 */
	private $numeric_code;
	/**
	 * @var int
	 */
	private $population;
	/**
	 * @var string
	 */
	private $region;
	/**
	 * @var array[]
	 */
	private $regional_blocs;
	/**
	 * @var string
	 */
	private $sub_region;
	/**
	 * @var string[]
	 */
	private $timezones;
	/**
	 * @var string[]
	 */
	private $top_level_domains;
	/**
	 * @var array
	 */
	private $translations;
	// end private members

	// getters
	public function get_alpha2_code(): string { return $this->alpha2_code; }
	public function get_alpha3_code(): string { return $this->alpha3_code; }
	public function get_alt_spellings(): array { return $this->alt_spellings; }
	public function get_area(): float { return $this->area; }
	public function get_borders(): array { return $this->borders; }
	public function get_calling_codes(): array { return $this->calling_codes; }
	public function get_capital(): string { return $this->capital; }
	public function get_cioc(): string { return $this->cioc; }
	public function get_currencies(): array { return $this->currencies; }
	public function get_demonym(): string { return $this->demonym; }
	public function get_flag(): string { return $this->flag; }
	public function get_gini(): float { return $this->gini; }
	public function get_languages(): array { return $this->languages; }
	public function get_lat_lng(): array { return $this->lat_lng; }
	public function get_name(): string { return $this->name; }
	public function get_native_name(): string { return $this->native_name; }
	public function get_numeric_code(): string { return $this->numeric_code; }
	public function get_population(): int { return $this->population; }
	public function get_region(): string { return $this->region; }
	public function get_regional_blocs(): array { return $this->regional_blocs; }
	public function get_sub_region(): string { return $this->sub_region; }
	public function get_timezones(): array { return $this->timezones; }
	public function get_top_level_domains(): array { return $this->top_level_domains; }
	public function get_translations(): array { return $this->translations; }
	// end getters

	// setters
	public function set_alpha2_code(string $code): void { $this->alpha2_code = substr($code, 0, 2); }
	public function set_alpha3_code(string $code): void { $this->alpha3_code = substr($code, 0, 3); }
	public function set_alt_spellings(array $spellings): void { $this->alt_spellings = $spellings; }
	public function set_area(float $area): void { $this->area = $area; }
	public function set_borders(array $borders): void { $this->borders = $borders; }
	public function set_calling_codes(array $codes): void { $this->calling_codes = $codes; }
	public function set_capital(string $capital): void { $this->capital = $capital; }
	public function set_cioc(string $cioc): void { $this->cioc = $cioc; }
	public function set_currencies(array $currencies): void { $this->currencies = $currencies; }
	public function set_demonym(string $demonym): void { $this->demonym = $demonym; }
	public function set_flag(string $url): void { $this->flag = $url; }
	public function set_gini(float $value): void { $this->gini = $value; }
	public function set_languages(array $languages): void { $this->languages = $languages; }
	/**
	 * @param array $lat_lng
	 *
	 * @throws \Exception
	 */
	public function set_lat_lng(array $lat_lng): void {
		if (count($lat_lng) === 2)
		{
			$this->lat_lng = [
				(float) $lat_lng[0],
				(float) $lat_lng[1]
			];
		}
		else
		{
			throw new Exception('Invalid lat_lng array value');
		}
	}
	public function set_name(string $name): void { $this->name = $name; }
	public function set_native_name(string $native_name): void { $this->native_name = $native_name; }
	public function set_numeric_code(string $code): void { $this->numeric_code = $code; }
	public function set_population(int $val): void { $this->population = $val; }
	public function set_region(string $region): void { $this->region = $region; }
	public function set_regional_blocs(array $regional_blocs): void { $this->regional_blocs = $regional_blocs; }
	public function set_sub_region(string $sub_region): void { $this->sub_region = $sub_region; }
	public function set_timezones(array $timezones): void { $this->timezones = $timezones; }
	public function set_top_level_domains(array $top_level_domains): void { $this->top_level_domains = $top_level_domains; }

	/**
	 * @param array $translations
	 *
	 * @throws Exception
	 */
	public function set_translations(array $translations): void {
		$this->translations = [];
		foreach ($translations as $lang_code => $translation)
		{
			if (strlen($lang_code) === 2)
			{
				$this->translations[strtolower($lang_code)] = $translation;
			}
			else
			{
				throw new Exception('Lang code ' . $lang_code . ' is invalid');
			}
		}
	}
	// end setters

	// public functions
	/**
	 * @param array $data
	 */
	public function from_array(array $data) {
		foreach ($data as $property_name => $val)
		{
			if (!is_null($val))
			{
				if (property_exists($this, $property_name))
				{
					try {
						if (method_exists($this, "set_{$property_name}"))
						{
							$this->{"set_" . $property_name}($val);
						}
					}
					catch (Exception $e){

					}
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function to_array(): array {
		return [
			'alpha2_code' => $this->alpha2_code,
			'alpha3_code' => $this->alpha3_code,
			'alt_spellings' => $this->alt_spellings,
			'area' => $this->area,
			'borders' => $this->borders,
			'calling_codes' => $this->calling_codes,
			'capital' => $this->capital,
			'cioc' => $this->cioc,
			'currencies' => $this->currencies,
			'demonym' => $this->demonym,
			'flag' => $this->flag,
			'gini' => $this->gini,
			'languages' => $this->languages,
			'lat_lng' => $this->lat_lng,
			'name' => $this->name,
			'native_name' => $this->native_name,
			'numeric_code' => $this->numeric_code,
			'population' => $this->population,
			'region' => $this->region,
			'regional_blocs' => $this->regional_blocs,
			'sub_region' => $this->sub_region,
			'timezones' => $this->timezones,
			'top_level_domains' => $this->top_level_domains,
			'translations' => $this->translations
		];
	}
	// end public functions
}