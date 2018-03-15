<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

// use Ch0c01dxyz\InstaToken\Objects\MediaId;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface LoginInterface
{
	/**
	 * Get URL Login redirect Instagram
	 */
	public function getLogin () : string;

	/**
	 * Get Instagram Authorization
	 *
	 * param string $code
	 */
	public function doAuth ( string $code ) : array;
}