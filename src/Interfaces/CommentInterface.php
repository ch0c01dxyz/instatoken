<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\CommentId;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface CommentInterface
{
	/**
	 * Get List recent comments on defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function listComment ( MediaId $mediaId ) : array;

	/**
	 * Send comment to Media
	 *
	 * @param object MediaId $mediaId
	 * @param string $comment
	 * @return array
	 */
	public function sendComment ( MediaId $mediaId, string $comment ) : array;

	/**
	 * Delete comment on Media
	 *
	 * @param object MediaId $mediaId
	 * @param object CommentId $commentId
	 * @return array
	 */
	public function deleteComment ( MediaId $mediaId, CommentId $commentId ) : array;
}