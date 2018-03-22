<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class AccessToken implements ObjectInterface
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
	public function __construct(string $at = null)
	{
		$this->accessToken = $at;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($value)
	{
		$this->accessToken = $value;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return $this->accessToken;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}