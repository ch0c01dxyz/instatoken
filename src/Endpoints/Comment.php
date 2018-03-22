<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Comment;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\CommentId;
use Ch0c01dxyz\InstaToken\Interfaces\CommentInterface;
use Ch0c01dxyz\InstaToken\Exceptions\CommentException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Comment implements CommentInterface
{
	use TokenAccessorTrait, EndpointTrait;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * @var \Http\Message\MultipartStream\MultipartStreamBuilder
	 */
	protected $builder;

	/**
	 * New instance of Comment class
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
		$this->token = $token ?: new AccessToken();
		$this->builder = new MultipartStreamBuilder();
	}

	/**
	 * Get List recent comments on defined Media
	 *
	 * @return array
	 */
	public function listComment(MediaId $mediaId): array
	{
		$endpoint = (new Comment)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withComment();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest ($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new CommentException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Send comment to Media
	 *
	 * @return array
	 */
	public function sendComment(MediaId $mediaId, string $comment): array
	{
		if (!$comment) {
			throw new \InvalidArgumentException(
				"Invalid comment."
			);
		}

		$endpoint = (new Comment)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withComment();
		$uri = new Uri((string)$endpoint);
		$this->builder->addResource("access_token", $this->getAccessToken());
		$this->builder->addResource("text", $comment);

		$request = $this->requestFactory->createRequest(
			"POST",
			(string)$uri,
			[
				"Content-Type" => sprintf('multipart/form-data; boundary="%s"', $this->builder->getBoundary())
			],
			(string)$this->builder->build()
		);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new CommentException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Delete comment on Media
	 *
	 * @return array
	 */
	public function deleteComment(MediaId $mediaId, CommentId $commentId): array
	{
		$endpoint = (new Comment)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withComment()
			->withCommentId((string)$commentId);
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("DELETE", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new CommentException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}