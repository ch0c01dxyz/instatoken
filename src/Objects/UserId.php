<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class UserId
{
	/**
	 * @var userId
	 */
	protected $userId;

	/**
	 * UserId Constructor
	 *
	 * @param int
	 */
	public function __construct ( int $uid )
	{
		$this->userId = $uid;
	}

	/**
	 * @return int
	 */
	public function __toInt () : int
	{
		return $this->userId;
	}
}