<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class MediaId implements ObjectInterface
{
	/**
	 * @var string
	 */
	protected $id;

	/**
	 * Media ID constructor
	 *
	 * @param string $id
	 */
	public function __construct(string $id = null)
	{
		$this->id = $id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($value)
	{
		$this->id = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}