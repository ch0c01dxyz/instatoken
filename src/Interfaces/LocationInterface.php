<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\LocationId;
use Ch0c01dxyz\InstaToken\Objects\Map;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface LocationInterface
{
	/**
	 * Get Information about Location
	 *
	 * @param object LocationId $locationId
	 * @return array
	 */
	public function infoLocation ( LocationId $locationId ) : array;

	/**
	 * Get list of Media object from given Location
	 *
	 * @param object LocationId $locationId
	 * @return array
	 */
	public function listMediaLocation ( LocationId $locationId ) : array;

	/**
	 * Search location by given Geographic coordinate
	 *
	 * @param object Map $map
	 * @return array
	 */
	public function searchLocation ( Map $map ) : array;
}