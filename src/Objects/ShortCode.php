<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class ShortCode
{
	/**
	 * @var shortCode
	 */
	protected $shortCode;

	/**
	 * Short Code constructor
	 *
	 * @param string $sc
	 */
	public function __construct ( string $sc )
	{
		$this->shortCode = $sc;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->shortCode;
	}
}