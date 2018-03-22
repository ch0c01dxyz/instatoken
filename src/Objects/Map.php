<?php

declare (strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Objects;

use Ch0c01dxyz\InstaToken\ObjectInterface;
use Ch0c01dxyz\InstaToken\Builder\MapBuilderInterface;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Map implements ObjectInterface
{
	/**
	 * @var Map
	 */
	protected $map;

	/**
	 * Map constructor
	 *
	 * @param MapBuilderInterface $map
	 */
	public function __construct(MapBuilderInterface $map)
	{
		$this->map = $map;
	}

	/**
	 * For chainability purpose.
	 */
	public static function create()
	{
		return new static(new Ch0c01dxyz\InstaToken\Builder\MapBuilder());
	}

	/**
	 * Get map latitude.
	 *
	 * @return float
	 * @throws \RuntimeException
	 */
	public function getLatitude(): float
	{
		return $this->map->getLatitude();
	}

	/**
	 * Get map longitude.
	 *
	 * @return float
	 * @throws \RuntimeException
	 */
	public function getLongitude(): float
	{
		return $this->map->getLongitude();
	}

	/**
	 * Get map distance.
	 *
	 * @return integer
	 * @throws \RuntimeException
	 */
	public function getDistance(): int
	{
		return $this->map->getDistance();
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(): string
	{
		return json_encode($this->map->build(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Get map builder instance.
	 *
	 * @return MapBuilderInterface
	 */
	public function getMap()
	{
		return $this->map;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string
	{
		return $this->get();
	}
}