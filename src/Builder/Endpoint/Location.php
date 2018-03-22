<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Location implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $location = [];

	public function withLocations()
	{
		$q = clone $this;
		$q->location[] = 'locations';

		return $q;
	}

	public function withLocationId(string $id)
	{
		$q = clone $this;
		$q->location[] = $id;

		return $q;
	}

	public function withMedia()
	{
		$q = clone $this;
		$q->location[] = 'media';

		return $q;
	}

	public function withRecent()
	{
		$q = clone $this;
		$q->location[] = 'recent';

		return $q;
	}

	public function withSearch()
	{
		$q = clone $this;
		$q->location[] = 'search';

		return $q;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->location;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->location)
		);
	}
}