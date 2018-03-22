<?php

namespace Ch0c01dxyz\InstaToken;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */

if (!function_exists(__NAMESPACE__ . "\\buildURLQuery")) {
	function buildURLQuery(array $q)
	{
		$k = array_keys($q);
		$v = array_values($q);
		$n = array_map(function($a, $b) {
			return sprintf("%s=%s", $a, $b);
		}, $k, $v);

		return implode("&", $n);
	}
}

if (!function_exists(__NAMESPACE__ . "\\getRedirectURI")) {
	function getRedirectURI(CredentialBuilderInterface $cred)
	{
		$endpoint = (new \Ch0c01dxyz\InstaToken\Builder\Endpoint\OAuth2)
			->withOAuth()
			->withAuthorize();
		$query = buildURLQuery([
			'client_id' => $cred->getAppID(),
			'redirect_uri' => $cred->getAppCallback(),
			'response_type' => 'code',
			'scope' => $cred->getAppScope()
		]);
		$uri = (new \GuzzleHttp\Psr7\Uri((string)$endpoint))
			->withQuery($query);

		return (string)$uri;
	}
}