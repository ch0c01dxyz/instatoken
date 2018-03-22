<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class ShortCode implements ObjectInterface
{
	/**
	 * @var string
	 */
	protected $code;

	/**
	 * Short Code constructor
	 *
	 * @param string $code
	 */
	public function __construct(string $code)
	{
		$this->code = $code;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($value)
	{
		$this->code = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return $this->code;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}