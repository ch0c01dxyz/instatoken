<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Action implements ObjectInterface
{
	/**
	 * @var action
	 */
	protected $action;

	/**
	 * Action constructor
	 *
	 * @param string $action
	 */
	public function __construct(string $action)
	{
		$this->action = $action;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get()
	{
		return $this->action;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->action;
	}
}