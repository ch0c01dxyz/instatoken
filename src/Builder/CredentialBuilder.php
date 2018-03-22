<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class CredentialBuilder implements CredentialBuilderInterface
{
	/**
	 * @var array
	 */
	private $cred = [];

	/**
	 * {@inheritdoc}
	 */
	public function setAppID($id)
	{
		$this->cred['app_id'] = $id;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setAppSecret($secret)
	{
		$this->cred['app_secret'] = $secret;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setAppCallback($callback)
	{
		$this->cred['app_callback'] = $callback;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setAppScope($scope)
	{
		$this->cred['app_scope'] = $scope;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAppID(): string
	{
		if (!isset($this->cred['app_id'])) {
			throw new \RuntimeException(
				"Application ID was not set."
			);
		}

		return $this->cred['app_id'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAppSecret(): string
	{
		if (!isset($this->cred['app_secret'])) {
			throw new \RuntimeException(
				"Application secret was not set."
			);
		}

		return $this->cred['app_secret'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAppCallback(): string
	{
		if (!isset($this->cred['app_callback'])) {
			throw new \RuntimeException(
				"Application callback was not set."
			);
		}

		return $this->cred['app_callback'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAppScope(): string
	{
		if (!isset($this->cred['app_scope'])) {
			throw new \RuntimeException(
				"Application scope was not set."
			);
		}

		return $this->cred['app_scope'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->cred;
	}
}