<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Action
{
	/**
	 * @var action
	 */
	protected $action;

	/**
	 * Action constructor
	 *
	 * @param string $ac
	 */
	public function __construct ( string $action )
	{
		$this->action = $action;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->action;
	}
}