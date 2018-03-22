<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Users implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $user = [];

	public function withUsers()
	{
		$q = clone $this;
		$q->user[] = 'users';

		return $q;
	}

	public function withSelf()
	{
		$q = clone $this;
		$q->user[] = 'self';

		return $q;
	}

	public function withUserId(string $id)
	{
		$q = clone $this;
		$q->user[] = $id;

		return $q;
	}

	public function withMedia()
	{
		$q = clone $this;
		$q->user[] = 'media';

		return $q;
	}

	public function withRecent()
	{
		$q = clone $this;
		$q->user[] = 'recent';

		return $q;
	}

	public function withLiked()
	{
		$q = clone $this;
		$q->user[] = 'liked';

		return $q;
	}

	public function withSearch()
	{
		$q = clone $this;
		$q->user[] = 'search';

		return $q;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->user;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->build())
		);
	}
}