<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class UserId implements ObjectInterface
{
	/**
	 * @var integer
	 */
	protected $userId;

	/**
	 * UserId Constructor
	 *
	 * @param integer $id
	 */
	public function __construct(int $id)
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
		return (string)$this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}