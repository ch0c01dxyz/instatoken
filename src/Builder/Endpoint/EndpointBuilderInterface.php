<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

use Ch0c01dxyz\InstaToken\BuilderInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface EndpointBuilderInterface extends BuilderInterface
{
	const INSTAGRAM_BASE_API_URL = "https://api.instagram.com";
	
	const INSTAGRAM_BASE_URL = "https://api.instagram.com/v1";
}