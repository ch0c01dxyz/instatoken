<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Name
{
	/**
	 * @var name
	 */
	protected $name;

	/**
	 * Name constructor
	 *
	 * @param string $n
	 */
	public function __construct ( string $n )
	{
		$this->name = $n;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->name;
	}
}