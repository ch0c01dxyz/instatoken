<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Objects;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class MediaId
{
	/**
	 * @var mediaId
	 */
	protected $mediaId;

	/**
	 * Media ID constructor
	 *
	 * @param int $mid
	 */
	public function __construct ( int $mid )
	{
		$this->mediaId = $mid;
	}

	/**
	 * @return int
	 */
	public function __toInt () : int
	{
		return $this->mediaId;
	}
}