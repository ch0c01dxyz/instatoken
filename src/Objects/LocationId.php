<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class LocationId
{
	/**
	 * @var locationId
	 */
	protected $locationId;

	/**
	 * Location ID constructor
	 *
	 * @param int $lid
	 */
	public function __construct ( int $lid )
	{
		$this->locationId = $lid;
	}

	/**
	 * @return int
	 */
	public function __toInt () : int
	{
		return $this->locationId;
	}

	public function __toString () : string
	{
		return ( string ) $this->locationId;
	}
}