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
		if ( is_string ( $this->mediaId ) )
		{
			return array_search ( $this->mediaId, $this->listAction );
		}

		return $this->mediaId;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		if ( is_int ( $this->mediaId ) )
		{
			return $this->listAction[ $this->mediaId ];
		}

		return $this->mediaId;
	}
}