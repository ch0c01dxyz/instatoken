<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class MapBuilder implements MapBuilderInterface
{
	/**
	 * @var array
	 */
	private $map = [];

	/**
	 * {@inheritdoc}
	 */
	public function latitude($latitude)
	{
		$this->map['lat'] = $latitude;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function longitude($longitude)
	{
		$this->map['lng'] = $longitude;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function distance($distance)
	{
		$this->map['distance'] = $distance;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLatitude()
	{
		if (!isset($this->map['lat'])) {
			throw new \RuntimeException(
				"Map latitude has not been set."
			);
		}

		return $this->map['lat'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLongitude()
	{
		if (!isset($this->map['lng'])) {
			throw new \RuntimeException(
				"Map longitude has not been set."
			);
		}

		return $this->map['lng'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDistance()
	{
		if (!isset($this->map['distance'])) {
			throw new \RuntimeException(
				"Map distance has not been set."
			);
		}

		return $this->map['distance'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->map;
	}
}