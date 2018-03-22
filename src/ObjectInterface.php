<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface ObjectInterface
{
	/**
	 * Set value from instantiated object.
	 *
	 * @param mixed $value
	 */
	public function set($value);
	
	/**
	 * Get value from instantiated object.
	 *
	 * @return string
	 */
	public function get(): string;

	/**
	 * {@inheritdoc}
	 */
	public function __toString(): string;
}