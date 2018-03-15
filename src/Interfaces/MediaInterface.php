<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\ShortCode;
use Ch0c01dxyz\InstaToken\Objects\Map;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface MediaInterface
{
	/**
	 * Get Information from given Media
	 *
	 * @return array
	 */
	public function readMedia ( MediaId $mediaId ) : array;

	/**
	 * Get Information from given Shortcoded Media
	 *
	 * @return array
	 */
	public function infoMedia ( ShortCode $shortCode ) : array;

	/**
	 * Search recent Media from given Area
	 *
	 * @return array
	 */
	public function searchMedia ( Map $map ) : array;
}