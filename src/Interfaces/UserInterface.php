<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\Name;
use Ch0c01dxyz\InstaToken\Objects\UserId;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface UserInterface
{
	/**
	 * Get User Information from Access Token
	 *
	 * @return array
	 */
	public function getSelf () : array;

	/**
	 * Get User Information from UserId
	 *
	 * @return array
	 */
	public function getInfo ( UserId $userId ) : array;

	/**
	 * Get recent User Media
	 *
	 * @return array
	 */
	public function getMedia () : array;

	/**
	 * Get Media liked by User
	 *
	 * @return array
	 */
	public function getLiked () : array;

	/**
	 * Search user by Name in Application
	 *
	 * @param object Name $name
	 * @return array
	 */
	public function searchUser ( Name $name ) : array;

	/**
	 * Get recent media from given User
	 *
	 * @param object UserId $userId
	 * @return array
	 */
	public function readUserMedia ( UserId $userId ) : array;
}