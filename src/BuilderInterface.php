<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface BuilderInterface
{
	/**
	 * Build previously given payload.
	 *
	 * @return array
	 */
	public function build();
}