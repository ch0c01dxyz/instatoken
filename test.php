<?php
	require 'vendor/autoload.php';

	$instatoken = new Ch0c01dxyz\InstaToken\Endpoints\User ();

	$instatoken->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );
print_r ( $instatoken->getSelf () );
	// $instatoken->setUserId ( "4702717189" );
	// $instatoken->setMap ( -6.8909203, 108.729098, 100 );
	// $map = new Ch0c01dxyz\InstaToken\Objects\LocationId ( 399201265 );
	// print_r ( $instatoken->listMediaLocation ( $map ) );

	// print_r ( $instatoken->getMedia () );
	// print_r ( $instatoken->getLiked () );
	// print_r ( $instatoken->searchUser ( "ch0c01d" ) );
	// print_r ( $instatoken->changeRelation ( 1 ) );