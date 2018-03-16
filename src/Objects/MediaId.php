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
	 * @param string $mediaId
	 */
	public function __construct ( string $mediaId )
	{
		$this->mediaId = $mediaId;
	}

	/**
	 * @return string
	 */
	public function __toString () : string
	{
		return $this->mediaId;
	}
}