<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Login;
use Ch0c01dxyz\InstaToken\Exception\LoginException;
use PHPUnit\Framework\TestCase;

class TestLogin extends TestCase
{
	public function testCanGetInstance ()
	{
		$login = new Login ( "0120c6f3f0724314ac04260e0f3a46f7", "e59e924238ff48f4aa8c19fb55642519", "https://appgram.ngrok.io/api/oauth", "basic+likes+relationships+comments+public_content+follower_list" );

		$this->assertInstanceOf ( Login::class, $login );
	}

	public function testGetUriLogin ()
	{
		$login = new Login ( "0120c6f3f0724314ac04260e0f3a46f7", "e59e924238ff48f4aa8c19fb55642519", "https://appgram.ngrok.io/api/oauth", "basic+likes+relationships+comments+public_content+follower_list" );

		$this->assertInternalType ( "object", $login );

		$this->assertInstanceOf ( Login::class, $login );

		$this->assertEquals ( "https://api.instagram.com/oauth/authorize/?client_id=0120c6f3f0724314ac04260e0f3a46f7&redirect_uri=https://appgram.ngrok.io/api/oauth&response_type=code&scope=basic+likes+relationships+comments+public_content+follower_list", $login->getLogin () );
	}

	// public function testCandoAuth ()
	// {

	// }
}