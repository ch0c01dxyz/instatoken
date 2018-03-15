<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class CommentId
{
	/**
	 * @var commentId
	 */
	protected $commentId;

	/**
	 * Comment ID constructor
	 *
	 * @param int $cid
	 */
	public function __construct ( int $cid )
	{
		$this->commentId = $cid;
	}

	/**
	 * @return int
	 */
	public function __toInt () : int
	{
		return $this->commentId;
	}
}