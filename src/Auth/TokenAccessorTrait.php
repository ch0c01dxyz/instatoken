<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Auth;

use Ch0c01dxyz\InstaToken\Objects\AccessToken;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
trait TokenAccessorTrait
{
	private $token;

	/**
	 * {@inheritdoc}
	 */
	public function setAccessToken(string $token)
	{
		$this->token->set($token);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAccessToken()
	{
		return $this->token->get();
	}
}