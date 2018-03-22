<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

class Media implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $media = [];

	public function withMedia()
	{
		$q = clone $this;
		$q->media[] = 'media';

		return $q;
	}

	public function withMediaId(string $id)
	{
		$q = clone $this;
		$q->media[] = $id;

		return $q;
	}

	public function withShortcode(string $code)
	{
		$q = clone $this;
		$q->media[] = 'shortcode';
		$q->media[] = $code;

		return $q;
	}

	public function withSearch()
	{
		$q = clone $this;
		$q->media[] = 'search';

		return $q;
	}

	public function build()
	{
		return $this->media;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->media)
		);
	}
}