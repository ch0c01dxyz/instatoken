<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Like implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $like = [];

	public function withMedia()
	{
		$q = clone $this;
		$q->like[] = 'media';

		return $q;
	}

	public function withMediaId(string $id)
	{
		$q = clone $this;
		$q->like[] = $id;

		return $q;
	}

	public function withLikes()
	{
		$q = clone $this;
		$q->like[] = 'likes';

		return $q;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->like;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->like)
		);
	}
}