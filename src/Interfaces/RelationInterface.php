<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Interfaces;

use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\Action;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
interface RelationInterface
{
	/**
	 * Get User Following
	 *
	 * @return array
	 */
	public function getFollow () : array;

	/**
	 * Get User Follower
	 *
	 * @return array
	 */
	public function getFollowedBy () : array;

	/**
	 * Get User Request Follow List
	 *
	 * @return array
	 */
	public function getRequestedBy () : array;

	/**
	 * Get User Relationship
	 *
	 * param object UserId $userId
	 * @return array
	 */
	public function getRelation ( UserId $userId ) : array;

	/**
	 * Change user Relationship
	 *
	 * @param object UserId $userId
	 * @param object Action $action
	 * @return array
	 */
	public function changeRelation ( UserId $userId, Action $action ) : array;
}