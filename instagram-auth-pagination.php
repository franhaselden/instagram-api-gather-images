<?php

$data = getImageData();

foreach($data['images'] as $pic){

	$caption = $pic['caption'];
	$caption_match = checkCaptions($caption);
	$image = $pic['image'];

	if($caption_match == true){
		echo '<img src="'.$image.'" />';
	}
}


function getImageData(){
	$user_id = '359698742';
	$access_token = '359698742.5732728.8e2c836f85d449e9b2bf848df6106585';

	$request_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?access_token='.$access_token.'&count=33';

	$dataJSON = getJSON($request_url);
	$alldata = json_decode($dataJSON,true);

	// Initialises the array
	$data = array(
	    "pagination" => $alldata['pagination']['next_url'],
	    "images" => array()
	);

	foreach($alldata['data'] as $pic)
	{
	    $caption = $pic['caption']['text'];
	    $image = $pic['images']['standard_resolution']['url'];
	    $data['images'][] = array( "image" => $image, "caption" => $caption);
	}

	for ($counter = 1; $counter <= 1; $counter++) {
	    $request_url = $data['pagination'];
	    $dataJSON = getJSON($request_url);
		$alldata = json_decode($dataJSON,true);

		foreach($alldata['data'] as $pic)
		{
		    $caption = $pic['caption']['text'];
		    $image = $pic['images']['standard_resolution']['url'];
		    $data['images'][] = array( "image" => $image, "caption" => $caption);
		}
	}
	return $data;
}

function getJSON($request_url){
	$curl = curl_init($request_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$pictures = curl_exec($curl);
	curl_close($curl);
	return $pictures;
}

function checkCaptions($caption){
	if (strpos($caption,'knitting') !== false) {
		return true;
	}else if (strpos($caption,'sewing') !== false) {
		return true;
	}else if (strpos($caption,'craft') !== false) {
		return true;
	}else if (strpos($caption,'yarn') !== false) {
		return true;
	}else if (strpos($caption,'knit') !== false) {
		return true;
	}else if (strpos($caption,'sew') !== false) {
		return true;
	}else if (strpos($caption,'fabric') !== false) {
		return true;
	}else{
		return false;
	}
}

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