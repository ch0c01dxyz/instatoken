<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Name implements ObjectInterface
{
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * Name constructor
	 *
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->name = $name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return $this->name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}