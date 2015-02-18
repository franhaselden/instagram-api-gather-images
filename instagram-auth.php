<?php

/* Set the generic info */
//$client_id = '573272892ef149b7bfcd4391d723dd10';
//$client_secret = '9fd3a4d9086c4e549edab93cb673c850';
//$redirect_url = 'http://www.eatsleepknit.co.uk';

$user_id = '359698742';
$access_token = '359698742.5732728.8e2c836f85d449e9b2bf848df6106585';
$media_request_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?access_token='.$access_token.'&count=33';
//echo $media_request_url;

$curl = curl_init($media_request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$pictures = curl_exec($curl);
curl_close($curl);

$pics = json_decode($pictures,true);

foreach($pics['data'] as $pic){

	$caption = $pic['caption']['text'];
	$hashtags = checkHashtags($caption);
	$image = $pic['images']['standard_resolution']['url'];

	if($hashtags == true){
		echo '<img src="'.$image.'" />';
	}
}

/* Checks hashtags to see if they contain certain matches */
function checkHashtags($caption){
	if (strpos($caption,'#') !== false) {
    	if (preg_match_all("/#(\w+)/", $caption, $matches)) {

    		// Removes the non-hashtag part of the array
    		unset($matches[1]);

    		/* Runs through the $matches to check for specific words */
		  	foreach ($matches as $match){
		  		foreach($match as $key){
		  			if (strpos($caption,'#knitting') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#sewing') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#craft') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#yarn') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#knit') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#sew') !== false) {
		  				return true;
		  			}else if (strpos($caption,'#fabric') !== false) {
		  				return true;
		  			}else{
		  				return false;
		  			}
		  		}
		  	}
		}else{
			return false;
		}
	}else{
		return false;
	}
}



?>