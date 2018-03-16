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
	 * @var listAction
	 */
	protected $listAction = [
		"follow",
		"unfollow",
		"approve",
		"ignore"
	];

	/**
	 * Action constructor
	 *
	 * @param int $ac
	 */
	public function __construct ( int $ac )
	{
		$this->action = $this->listAction[ $ac ];
	}

	/**
	 * @return int
	 */
	public function __toInt () : int
	{
		if ( is_string ( $this->action ) )
		{
			return array_search ( $this->action, $this->listAction );
		}

		return $this->action;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		if ( is_int ( $this->action ) )
		{
			return $this->listAction[ $this->action ];
		}

		return $this->action;
	}
}