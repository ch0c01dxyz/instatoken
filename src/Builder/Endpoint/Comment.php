<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Comment implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $comment = [];

	public function withMedia()
	{
		$q = clone $this;
		$q->comment[] = 'media';

		return $q;
	}

	public function withMediaId(string $id)
	{
		$q = clone $this;
		$q->comment[] = $id;

		return $q;
	}

	public function withComment()
	{
		$q = clone $this;
		$q->comment[] = 'comments';

		return $q;
	}

	public function withCommentId(string $id)
	{
		$q = clone $this;
		$q->comment[] = $id;

		return $q;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->comment;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->comment)
		);
	}
}