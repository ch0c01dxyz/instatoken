<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\TagName;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface TagInterface
{
	/**
	 * Get recent Tag Media
	 *
	 * @param object TagName $tagName
	 * @return array
	 */
	public function listTag ( TagName $tagName ) : array;

	/**
	 * Get Information about Tag object
	 *
	 * @param object TagName $tagName
	 * @return array
	 */
	public function infoTag ( TagName $tagName ) : array;

	/**
	 * Search tag by Name
	 *
	 * @param object TagName $tagName
	 * @return array
	 */
	public function searchTag ( TagName $tags ) : array;
}