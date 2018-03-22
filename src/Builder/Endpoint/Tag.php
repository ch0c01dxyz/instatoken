<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Tag implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $tag = [];

	public function withTags()
	{
		$q = clone $this;
		$q->tag[] = 'tags';

		return $q;
	}

	public function withTagName(string $name)
	{
		$q = clone $this;
		$q->tag[] = $name;

		return $q;
	}

	public function withMedia()
	{
		$q = clone $this;
		$q->tag[] = 'media';

		return $q;
	}

	public function withRecent()
	{
		$q = clone $this;
		$q->tag[] = 'recent';

		return $q;
	}

	public function withSearch()
	{
		$q = clone $this;
		$q->tag[] = 'search';

		return $q;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->tag;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->tag)
		);
	}
}