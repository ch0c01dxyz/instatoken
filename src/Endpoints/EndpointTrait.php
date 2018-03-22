<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
trait EndpointTrait
{
	/**
	 * Render given data as json.
	 *
	 * @param mixed $data
	 * @return string
	 */
	public function renderAsJson($data)
	{
		return json_encode(
			$data,
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		);
	}

	/**
	 * Restore json serialized data into original form.
	 *
	 * @param string $data
	 * @param boolean $assoc
	 * @return mixed
	 */
	public function restoreFromJson($data, $assoc = false)
	{
		return json_decode($data, $assoc);
	}
}