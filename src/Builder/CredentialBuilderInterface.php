<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder;

use Ch0c01dxyz\InstaToken\BuilderInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface CredentialBuilderInterface extends BuilderInterface
{
	/**
	 * Set application ID.
	 *
	 * @param string $id
	 */
	public function setAppID(string $id);

	/**
	 * Set application secret.
	 *
	 * @param string $secret
	 */
	public function setAppSecret(string $secret);

	/**
	 * Set application callback.
	 *
	 * @param string $callback
	 */
	public function setAppCallback(string $callback);

	/**
	 * Set application scope.
	 *
	 * @param string $scope
	 */
	public function setAppScope($scope);

	/**
	 * Get application ID.
	 *
	 * @return string
	 */
	public function getAppID(): string;

	/**
	 * Get application secret.
	 *
	 * @return string
	 */
	public function getAppSecret(): string;

	/**
	 * Get application callback.
	 *
	 * @return string
	 */
	public function getAppCallback(): string;

	/**
	 * Get application scope.
	 *
	 * @return string
	 */
	public function getAppScope(): string;
}