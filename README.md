# InstaToken
Just simple Unofficial Instagram API using Token provided by Application

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ch0c01dxyz/instatoken/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ch0c01dxyz/instatoken/?branch=master)

## Features

- Get list Comment
- Send Comment
- Delete Comment
- Get list Like
- Send Like to Media
- Delete Like from Media
- Get Location info
- Get Media based on location
- Search Location from given params
- Get Media info
- Search Media from given location
- Get list Follower
- Get list Following
- Get follow Request ( BETA )
- Get Relationship info
- Change Relationship
- Get Tag information
- Search TagName
- Get User info ( Base Info / Media )
- Search User

## Quick Start

```php
$instaToken = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$instaToken->setToken( "USER_APP_TOKEN" );

print_r ( $instaToken->getSelf );
```

Result above code:

```
Array
(
    [data] => Array
        (
            [id] => 4702717189
            [username] => ch0c01d.xyz
            [profile_picture] => https://scontent.cdninstagram.com/vp/b3d98293afb0f953ddeed49f43ef6a3a/5B2BC280/t51.2885-19/s150x150/25007128_351216438678074_8197259836799320064_n.jpg
            [full_name] => ㅤ
            [bio] =>
            [website] => http://malanghost.com/
            [is_business] =>
            [counts] => Array
                (
                    [media] => 28
                    [follows] => 167
                    [followed_by] => 18115
                )
        )
    [meta] => Array
        (
            [code] => 200
        )
)
```

# Login Usage
- Get URL Login redirect to Instagram
```php
$appLogin = new Ch0c01dxyz\InstaToken\Endpoints\Login ( "applicationId", "applicationSecret", "applicationCallback" );

print_r ( $appLogin->getLogin (); );
```

- Get Instagram Authorization ( Access Token )
```php
$appLogin = new Ch0c01dxyz\InstaToken\Endpoints\Login ( "applicationId", "applicationSecret", "applicationCallback" );

// $code = from user authorization from getLogin() above.
print_r ( $appLogin->doAuth ( $code ); );
```

# Comment Usage
- Get list comment on Media
```php
$myComment = new Ch0c01dxyz\InstaToken\Endpoints\Comment ();

$myComment->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myComment->listComment ( $mediaId ) );
```

- Send comment on Media
```php
$myComment = new Ch0c01dxyz\InstaToken\Endpoints\Comment ();

$myComment->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myComment->sendComment ( $mediaId, "this is sample comment to the user media." ) );
```

- Delete comment on Media
```php
$myComment = new Ch0c01dxyz\InstaToken\Endpoints\Comment ();

$myComment->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );
$commentId = new Ch0c01dxyz\InstaToken\Objects\CommentId ( "USER_COMMENT_ID" );

print_r ( $myComment->listComment ( $mediaId, $commentId ) );
```

# Like Usage
- Get list Like on Media
```php
$myLike = new Ch0c01dxyz\InstaToken\Endpoints\Like ();

$myLike->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myLike->listLike ( $mediaId ) );
```

- Send Like to Media
```php
$myLike = new Ch0c01dxyz\InstaToken\Endpoints\Like ();

$myLike->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myLike->sendLike ( $mediaId ) );
```

- Delete Like from Media
```php
$myLike = new Ch0c01dxyz\InstaToken\Endpoints\Like ();

$myLike->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myLike->deleteLike ( $mediaId ) );
```

# Location Usage
- Get information about Location
```php
$myLocation = new Ch0c01dxyz\InstaToken\Endpoints\Location ();

$myLocation->setToken ( "USER_APP_TOKEN" );

$locationId = new Ch0c01dxyz\InstaToken\Objects\LocationId ( "USER_LOCATION_ID" );

print_r ( $myLocation->infoLocation ( $locationId ) );
```

- Get list Media from given Location
```php
$myLocation = new Ch0c01dxyz\InstaToken\Endpoints\Location ();

$myLocation->setToken ( "USER_APP_TOKEN" );

$locationId = new Ch0c01dxyz\InstaToken\Objects\LocationId ( "USER_LOCATION_ID" );

print_r ( $myLocation->listMediaLocation ( $locationId ) );
```

- Search Location based on Latitude / Longitude
```php
$myLocation = new Ch0c01dxyz\InstaToken\Endpoints\Location ();

$myLocation->setToken ( "USER_APP_TOKEN" );

$myMap = new Ch0c01dxyz\InstaToken\Objects\Map ( "latitude", "longitude", "distance" );

print_r ( $myLocation->searchLocation ( $myMap ) );
```

# Media Usage
- Get Information about Media
```php
$myMedia = new Ch0c01dxyz\InstaToken\Endpoints\Media ();

$myMedia->setToken ( "USER_APP_TOKEN" );

$mediaId = new Ch0c01dxyz\InstaToken\Objects\MediaId ( "USER_MEDIA_ID" );

print_r ( $myMedia->readMedia ( $mediaId ) );
```

- Get Information about shortcode Media
```php
$myMedia = new Ch0c01dxyz\InstaToken\Endpoints\Media ();

$myMedia->setToken ( "USER_APP_TOKEN" );

$shortCode = new Ch0c01dxyz\InstaToken\Objects\ShortCode ( "USER_SHORTCODE_MEDIA_ID" );

print_r ( $myMedia->readMedia ( $shortCode ) );
```

- Search Media from given Location ( latitude, longitude, distance )
```php
$myMedia = new Ch0c01dxyz\InstaToken\Endpoints\Media ();

$myMedia->setToken ( "USER_APP_TOKEN" );

$myMap = new Ch0c01dxyz\InstaToken\Objects\Map ( "latitude", "longitude", "distance" );

print_r ( $myMedia->searchMedia ( $myMap ) );
```

# Relation Usage
- Get user Following
```php
$myRelation = new Ch0c01dxyz\InstaToken\Endpoints\Relation ();

$myRelation->setToken ( "USER_APP_TOKEN" );

print_r ( $myRelation->getFollow () );
```

- Get user Follower
```php
$myRelation = new Ch0c01dxyz\InstaToken\Endpoints\Relation ();

$myRelation->setToken ( "USER_APP_TOKEN" );

print_r ( $myRelation->getFollowedBy () );
```

- Get user Request Follow
```php
$myRelation = new Ch0c01dxyz\InstaToken\Endpoints\Relation ();

$myRelation->setToken ( "USER_APP_TOKEN" );

print_r ( $myRelation->getRequestedBy () );
```

- Get user Relationship
```php
$myRelation = new Ch0c01dxyz\InstaToken\Endpoints\Relation ();

$myRelation->setToken ( "USER_APP_TOKEN" );

$userId = new Ch0c01dxyz\InstaToken\Objects\UserId ( "ID_OF_USER" );

print_r ( $myRelation->getRelation ( $userId ) );
```

- Change user Relationship
```php
$myRelation = new Ch0c01dxyz\InstaToken\Endpoints\Relation ();

$myRelation->setToken ( "USER_APP_TOKEN" );

$userId = new Ch0c01dxyz\InstaToken\Objects\UserId ( "ID_OF_USER" );

// List Action
// - Follow
// - Unfollow
// - Approve
// - Ignore
$action = new Ch0c01dxyz\InstaToken\Objects\Action ( "follow" );

print_r ( $myRelation->changeRelation ( $userId, $action ) );
```

# Tag Usage
- Get recent Tagged Media
```php
$myTag = new Ch0c01dxyz\InstaToken\Endpoints\Tag ();

$myTag->setToken ( "USER_APP_TOKEN" );

$tagName = new Ch0c01dxyz\InstaToken\Objects\TagName ( "NAME_OF_TAG" );

print_r ( $myTag->listTag ( $tagName ) );
```

- Get information about Tag
```php
$myTag = new Ch0c01dxyz\InstaToken\Endpoints\Tag ();

$myTag->setToken ( "USER_APP_TOKEN" );

$tagName = new Ch0c01dxyz\InstaToken\Objects\TagName ( "NAME_OF_TAG" );

print_r ( $myTag->infoTag ( $tagName ) );
```

- Searching Tag by Tagname
```php
$myTag = new Ch0c01dxyz\InstaToken\Endpoints\Tag ();

$myTag->setToken ( "USER_APP_TOKEN" );

$tagName = new Ch0c01dxyz\InstaToken\Objects\TagName ( "NAME_OF_TAG" );

print_r ( $myTag->searchTag ( $tagName ) );
```

# User Usage
- Get basic User information
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

print_r ( $myTag->getSelf () );
```

- Get User information from given userId
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

$userId = new Ch0c01dxyz\InstaToken\Objects\UserId ( "ID_OF_USER" );

print_r ( $myTag->getInfo ( $userId ) );
```

- Get current User Media
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

print_r ( $myTag->getMedia () );
```

- Get media liked by User
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

print_r ( $myTag->getLiked () );
```

- Search User by Name
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

$myName = new Ch0c01dxyz\InstaToken\Objects\Name ( "NAME_OF_USER" );

print_r ( $myTag->searchUser ( $myName ) );
```

- Getting recent Media from given userId
```php
$myUser = new Ch0c01dxyz\InstaToken\Endpoints\User ();

$myUser->setToken ( "USER_APP_TOKEN" );

$userId = new Ch0c01dxyz\InstaToken\Objects\UserId ( "ID_OF_USER" );

print_r ( $myTag->readUserMedia ( $userId ) );
```

# Contributors

- [Egar Rizki](https://github.com/ch0c01dxyz)

# License

BSD 3-Clause License

Copyright (c) 2017, Egar Rizki
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

* Neither the name of the copyright holder nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.