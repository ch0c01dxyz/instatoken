<?php

declare (strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Relationship;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\Action;
use Ch0c01dxyz\InstaToken\Interfaces\RelationInterface;
use Ch0c01dxyz\InstaToken\Exceptions\RelationException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Relation implements RelationInterface
{
	use TokenAccessorTrait, EndpointTrait;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\UserId
	 */
	protected $userId;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\Username
	 */
	protected $username;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\Action
	 */
	protected $action;

	/**
	 * @var \Http\Message\MultipartStream\MultipartStreamBuilder
	 */
	protected $builder;

	/**
	 * New instance of Relation class
	 *
	 * @param \Http\Client\HttpClient|null $httpClient
	 * @param \Http\Message\RequestFactory|null $requestFactory
	 */
	public function __construct(
		HttpClient $httpClient = null,
		RequestFactory $requestFactory = null,
		AccessToken $token = null
	) {
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find();
		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
		$this->builder = new MultipartStreamBuilder();
		$this->token = $token ?: new AccessToken();
	}

	/**
	 * Get User Following
	 *
	 * @return array
	 */
	public function getFollow() : array
	{
		$endpoint = (new Relationship)
			->withUsers()
			->withSelf()
			->withFollows();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new RelationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get User Follower
	 *
	 * @return array
	 */
	public function getFollowedBy(): array
	{
		$endpoint = (new Relationship)
			->withUsers()
			->withSelf()
			->withFollowedBy();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new RelationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get User Request Follow List
	 *
	 * @return array
	 */
	public function getRequestedBy(): array
	{
		$endpoint = (new Relationship)
			->withUsers()
			->withSelf()
			->withRequestedBy();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new RelationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get User Relationship
	 *
	 * @return array
	 */
	public function getRelation(UserId $userId): array
	{
		$endpoint = (new Relationship)
			->withUsers()
			->withUserId((string)$userId)
			->withRelationship();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new RelationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Change user Relationship
	 *
	 * @param object UserId $userId
	 * @param object Action $action
	 * @return array
	 */
	public function changeRelation ( UserId $userId, Action $action ) : array
	{
		$endpoint = (new Relationship)
			->withUsers()
			->withUserId((string)$userId)
			->withRelationship();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);

		$this->builder->addResource("action", (string)$action);

		$request = $this->requestFactory->createRequest(
			"POST",
			(string)$uri,
			[
				"Content-Type" => sprintf(
					'multipart/form-data; boundary="%s"',
					$this->builder->getBoundary()
				)
			],
			(string)$this->builder->build()
		);
		$response = $this->httpClient->sendRequest ( $request );

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new RelationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}