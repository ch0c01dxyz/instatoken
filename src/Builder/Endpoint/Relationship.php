<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Builder\Endpoint;

use Ch0c01dxyz\InstaToken\BuilderInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Relationship implements BuilderInterface
{
	/**
	 * @var array
	 */
	private $relationship = [];

	public function withUsers()
	{
		$q = clone $this;
		$q->relationship[] = 'users';

		return $q;
	}

	public function withSelf()
	{
		$q = clone $this;
		$q->relationship[] = 'self';

		return $q;
	}

	public function withFollows()
	{
		$q = clone $this;
		$q->relationship[] = 'follows';

		return $q;
	}

	public function withFollowedBy()
	{
		$q = clone $this;
		$q->relationship[] = 'followed-by';

		return $q;
	}

	public function withRequestedBy()
	{
		$q = clone $this;
		$q->relationship[] = 'requested-by';

		return $q;
	}

	public function withUserId(string $id)
	{
		$q = clone $this;
		$q->relationship[] = $id;

		return $q;
	}

	public function withRelationship()
	{
		$q = clone $this;
		$q->relationship[] = 'relationship';

		return $q;
	}

	public function build()
	{
		return $this->relationship;
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return sprintf(
			"%s/%s",
			EndpointBuilderInterface::INSTAGRAM_BASE_URL,
			implode('/', $this->relationship)
		);
	}
}