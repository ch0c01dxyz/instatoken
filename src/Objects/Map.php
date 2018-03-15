<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Map
{
	/**
	 * @var Map
	 */
	protected $map;

	/**
	 * Map constructor
	 *
	 * @param float $lat
	 * @param float $lng
	 * @param float $distance
	 */
	public function __construct ( float $lat, float $lng, int $distance )
	{
		$this->map = [
			"lat" => ( float ) $lat,
			"lng" => ( float ) $lng,
			"distance" => ( int ) $distance
		];
	}

	/**
	 * @return float Latitude
	 */
	public function getLat () : float
	{
		return $this->map[ "lat" ];
	}

	/**
	 * @return float Longitude
	 */
	public function getLng () : float
	{
		return $this->map[ "lng" ];
	}

	/**
	 * @return int Distance
	 */
	public function getDistance () : int
	{
		return $this->map[ "distance" ];
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return implode( ",", $this->map );
	}

	/**
	 * @return array
	 */
	public function __toArray () : array
	{
		return $this->map;
	}
}