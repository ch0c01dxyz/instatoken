<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class LocationId implements ObjectInterface
{
	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * Location ID constructor
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
	public function get()
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return (string)$this->get();
	}
}