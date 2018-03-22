<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\OAuth2;
use Ch0c01dxyz\InstaToken\Builder\CredentialBuilder;
use Ch0c01dxyz\InstaToken\Builder\CredentialBuilderInterface;
use Ch0c01dxyz\InstaToken\Interfaces\LoginInterface;
use Ch0c01dxyz\InstaToken\Exceptions\LoginException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Login implements LoginInterface
{
	use EndpointTrait;
	
	/**
	 * @var CredentialBuilderInterface
	 */
	private $cred;

	/**
	 * @var [type]
	 */
	protected $result;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * New instance of Login class
	 *
	 * @param string $appId
	 * @param string $appSecret
	 * @param string $appCallback
	 * @param \Http\Client\HttpClient|null $httpClient
	 * @param \Http\Message\RequestFactory|null $requestFactory
	 */
	public function __construct(
		HttpClient $httpClient = null,
		RequestFactory $requestFactory = null,
		CredentialBuilderInterface $cred
	) {
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find();
		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
		$this->cred = $cred ?: new CredentialBuilderInterface();
	}

	/**
	 * Get Instagram Authorization
	 *
	 * param string $code
	 */
	public function doAuth(string $code): array
	{
		if (!$code) {
			throw new LoginException(
				"Code required."
			);
		}

		$endpoint = (new OAuth2)
			->withOAuth()
			->withAccessToken();
		$uri = new Uri((string)$endpoint);

		$this->builder->addResource("client_id", $this->cred->getAppID());
		$this->builder->addResource("client_secret", $this->cred->getAppSecret());
		$this->builder->addResource("grant_type", "authorization_code");
		$this->builder->addResource("redirect_uri", $this->cred->getAppCallback());
		$this->builder->addResource("code", $code);

		$request = $this->requestFactory->createRequest(
			"POST",
			$uri,
			[
				"Content-Type" => sprintf(
					'multipart/form-data; boundary="%s"',
					$this->builder->getBoundary()
				)
			],
			(string)$this->builder->build()
		);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LoginException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}