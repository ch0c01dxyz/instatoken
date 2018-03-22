<?php

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class OAuth2 implements EndpointBuilderInterface
{
	/**
	 * @var array
	 */
	private $oauth = [];

	public function withOAuth()
	{
		$q = clone $this;
		$q->oauth[] = 'oauth';

		return $q;
	}

	public function withAuthorize()
	{
		$q = clone $this;
		$q->oauth[] = 'authorize';

		return $q;
	}

	public function withAccessToken()
	{
		$q = clone $this;
		$q->oauth[] = 'access_token';

		return $q;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return $this->oauth;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_API_URL,
			implode('/', $this->oauth)
		);
	}
}