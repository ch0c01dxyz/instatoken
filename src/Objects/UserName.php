<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class UserName
{
	/**
	 * @var userName
	 */
	protected $userName;

	/**
	 * Username Constructor
	 *
	 * @param string $un
	 */
	public function __construct ( string $un )
	{
		$this->userName = $un;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->userName;
	}
}