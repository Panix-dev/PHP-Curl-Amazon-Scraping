<?php
$curl = curl_init(); // data type curl resource

$search_string = "pc video games 2016";
$url = "https://www.amazon.com/s/field-keywords=$search_string";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

preg_match_all("!https://images-na.ssl-images-amazon.com/images/I/[^\s]*?._AC_US160_.jpg!", $result, $matches);

// Remove duplicates and fix keys
$images = array_values(array_unique($matches[0]));

for($i = 0; $i < count($images); $i++) {
	echo "<div style='float:left; margin:10px 0 0 0;' >";
	echo "<img src='$images[$i]' /><br/>";
	echo "</div>";
}

// close to save resources
curl_close($curl);