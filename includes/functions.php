<?php
	
	function mysql_prep($value, $connection)
	{
		$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysqli_real_escape_string");
		if($new_enough_php)
		{
			if($magic_quote_active)
			{
				$value = stripslashes($value);
			}
			$value = mysqli_real_escape_string($connection, $value);
		}
		else
		{
			if(!$magic_quote_active)
			{
				$value=addslashes($value);
			}
		}
		return $value;
	}
	
	//function to redirect to a page
	function redirect_to($url, $permanent = false) {
	if($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: '.$url);
	exit();
	}
	
	// This file is place to store all basic functions
	function confirm_query($result_set)
	{
		if(!$result_set)
		{
			die("Database query failed ".mysql_error());
		}
	}
	
	function getbranchbyid($id, $connection){
		$query = mysqli_query($connection,"SELECT Branch FROM users WHERE userid='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}

	function getdesignationbyid($id, $connection){
		$query = mysqli_query($connection,"SELECT role FROM users WHERE userid='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}
	
	function getnamebyid($id, $connection){
		$query = mysqli_query($connection,"SELECT fullname FROM users WHERE userid='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}
	function getpasswordbyid($id, $connection){
		$query = mysqli_query($connection,"SELECT password FROM users WHERE userid='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}

	// function to geocode address, it will return false if unable to geocode address
	function geocode($address){
 
	    // url encode the address
	    $address = urlencode($address);
	     
	    // google map geocode api url
	    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address={$address}";
	 
	    // get the json response
	    $resp_json = file_get_contents($url);
	     
	    // decode the json
	    $resp = json_decode($resp_json, true);
	 
	    // response status will be 'OK', if able to geocode given address 
	    if($resp['status']='OK'){
	 
	        // get the important data
	        $lati = $resp['results'][0]['geometry']['location']['lat'];
	        $longi = $resp['results'][0]['geometry']['location']['lng'];
	        $formatted_address = $resp['results'][0]['formatted_address'];
	         
	        // verify if data is complete
	        if($lati && $longi && $formatted_address){
	         
	            // put the data in the array
	            $data_arr = array();            
	             
	            array_push(
	                $data_arr, 
	                    $lati, 
	                    $longi, 
	                    $formatted_address
	                );
	             
	            return $data_arr;
	             
	        }else{
	            return false;
	        }
	         
	    }else{
	        return false;
	    }
	}

	function GetImageExtension($imagetype)
     {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
     }

     function getRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
	}

?>