<?php

/* Set the generic info */
//$client_id = '573272892ef149b7bfcd4391d723dd10';
//$client_secret = '9fd3a4d9086c4e549edab93cb673c850';
//$redirect_url = 'http://www.eatsleepknit.co.uk';

$user_id = '359698742';
$access_token = '359698742.5732728.8e2c836f85d449e9b2bf848df6106585';
$media_request_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?access_token='.$access_token;

$curl = curl_init($media_request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$pictures = curl_exec($curl);
curl_close($curl);

$pics = json_decode($pictures,true);

// display the url of the last image in standard resolution
echo $pics['data'][0]['images']['standard_resolution']['url'];



?>