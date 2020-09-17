<?php


  require 'config.php';

    $paymentURL=paymentURL();
	
	$entityId=entityId();
	$accessToken=accessToken();
	$developmentMode=developmentMode();
	$url = $paymentURL."/v1/checkouts";

$params=$_REQUEST;

	$url = $paymentURL."".$params['resourcePath']."?entityId=".$entityId;;


            
                	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer '.$accessToken));
	if($developmentMode=='dev'){
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	}else{
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		$res= curl_error($ch);
	}
	curl_close($ch);
    $responseData=json_decode($responseData,true);
    echo "<pre>";
    print_r($responseData);
