<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class TagName implements ObjectInterface
{
	/**
	 * @var string
	 */
	protected $tag;

	/**
	 * Tag Name constructor
	 *
	 * @param string $tag
	 */
	public function __construct(string $tag)
	{
		$this->tag = $tag;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($value)
	{
		$this->tag = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return $this->tag;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}