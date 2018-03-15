<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class AccessToken
{
	/**
	 * @var accessToken
	 */
	protected $accessToken;

	/**
	 * Access Token constructor
	 *
	 * @param string $at
	 */
	public function __construct ( string $at )
	{
		$this->accessToken = $at;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->accessToken;
	}
}