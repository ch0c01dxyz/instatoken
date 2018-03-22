<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder;

use Ch0c01dxyz\InstaToken\BuilderInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface MapBuilderInterface extends BuilderInterface
{
	/**
	 * Set map latitude.
	 *
	 * @param float $latitude
	 * @return this
	 */
	public function latitude($latitude);

	/**
	 * Set map longitude.
	 *
	 * @param float $longitude
	 * @return this
	 */
	public function longitude($longitude);

	/**
	 * Set map distance.
	 *
	 * @param integer $distance
	 * @return this
	 */
	public function distance($distance);

	/**
	 * Get map latitude.
	 *
	 * @return float
	 */
	public function getLatitude(): float;

	/**
	 * Get map longitude.
	 *
	 * @return float
	 */
	public function getLongitude(): float;

	/**
	 * Get map distance.
	 *
	 * @return integer
	 */
	public function getDistance(): int;
}