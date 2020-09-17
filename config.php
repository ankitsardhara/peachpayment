<?php


function developmentMode(){
	return 'dev';
	//return 'prod';
}
function paymentURL(){
	return 'https://test.oppwa.com'; //development;
	//return 'https://oppwa.com/'; // production;
}

function entityId(){

	// Dashboard -> Merchants -> click on merchant -> Development -> API Credentials
	return '***7a4c873384a2a01734ca9dac93535';//(Sender)
}
function accessToken(){
	// Dashboard -> Merchants -> click on merchant -> Development -> API Credentials
	return '***jN2E0Yzk3MzM4MTM3OTAxNzM0Y2E4YzU5YjJlMWR8a0FzdEJyY1M4UA==';//(Access Token)
}