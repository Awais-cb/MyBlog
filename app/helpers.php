<?php

	// Debug functions/helpers
	if (! function_exists('pr')) {
		function pr($text,$pretty=false) {
			if(!$pretty) {
				print_r($text);
			} else {
				echo "<pre>";
				print_r($text);
				echo "</pre>";
			}
		}
	}	

	if (! function_exists('pex')) {
		function pex($text,$msg="PeX") {
			pr($text,true);
			exit($msg);
		}
	}

	if (! function_exists('dump')) {
		function dump($data) {
	    	echo "<pre>";
	    	var_dump($data);
	    	echo "</pre>";
	    }
	}

	// Time functions/helpers
	if (! function_exists('now')) {
		function now() {
			return date('Y-m-d H:i:s', time());
		}
	}

	// General functions/helpers
	/**
	* Fetch user's geolocation related data
	* @param : { string } { $ip } { ip address to perform checks against }
	* @param : { string } { $purpose } { data you need about IP }
	* @author: manuelbcd [http://stackoverflow.com/users/3518053/manuelbcd]
	*/
	if (! function_exists('ip_info')) {
		function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
		    $output = NULL;
		    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
		        $ip = $_SERVER["REMOTE_ADDR"];
		        if ($deep_detect) {
		            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
		                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
		                $ip = $_SERVER['HTTP_CLIENT_IP'];
		        }
		    }
		    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
		    $continents = array(
		        "AF" => "Africa",
		        "AN" => "Antarctica",
		        "AS" => "Asia",
		        "EU" => "Europe",
		        "OC" => "Australia (Oceania)",
		        "NA" => "North America",
		        "SA" => "South America"
		    );
		    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
		        $ipdat = @json_decode(cb_curl("http://www.geoplugin.net/json.gp?ip=" . $ip));
		        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
		            switch ($purpose) {
		                case "location":
		                    $output = array(
		                        "city"           => @$ipdat->geoplugin_city,
		                        "state"          => @$ipdat->geoplugin_regionName,
		                        "country"        => @$ipdat->geoplugin_countryName,
		                        "country_code"   => @$ipdat->geoplugin_countryCode,
		                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
		                        "continent_code" => @$ipdat->geoplugin_continentCode
		                    );
		                    break;
		                case "address":
		                    $address = array($ipdat->geoplugin_countryName);
		                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
		                        $address[] = $ipdat->geoplugin_regionName;
		                    if (@strlen($ipdat->geoplugin_city) >= 1)
		                        $address[] = $ipdat->geoplugin_city;
		                    $output = implode(", ", array_reverse($address));
		                    break;
		                case "city":
		                    $output = @$ipdat->geoplugin_city;
		                    break;
		                case "state":
		                    $output = @$ipdat->geoplugin_regionName;
		                    break;
		                case "region":
		                    $output = @$ipdat->geoplugin_regionName;
		                    break;
		                case "country":
		                    $output = @$ipdat->geoplugin_countryName;
		                    break;
		                case "countrycode":
		                    $output = @$ipdat->geoplugin_countryCode;
		                    break;
		            }
		        }
		    }
		    return $output;
		}
	}
?>