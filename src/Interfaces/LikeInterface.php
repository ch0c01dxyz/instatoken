<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\MediaId;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface LikeInterface
{
	/**
	 * Get list User who have likes defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function listLike ( MediaId $mediaId ) : array;

	/**
	 * Send like to defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function sendLike ( MediaId $mediaId ) : array;

	/**
	 * Remove like from defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function deleteLike ( MediaId $mediaId ) : array;
}