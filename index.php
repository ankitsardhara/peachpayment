<?php 

   require 'config.php';

    $paymentURL=paymentURL();
	
	$entityId=entityId();
	$accessToken=accessToken();
	$developmentMode=developmentMode();
	$url = $paymentURL."/v1/checkouts";

	$data = "entityId=".$entityId.
                "&amount=92.00" .
                "&currency=ZAR" .
                "&paymentType=DB";
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer '.$accessToken));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	if($developmentMode=='dev'){
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	}else{
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
	}
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);


	if(curl_errno($ch)) {

		echo curl_error($ch);
		die;
	}
curl_close($ch);

$responseData=json_decode($responseData,true);

if(!isset($responseData['id'])){
 echo "something went wrong";
 
 die;
}

$checkout_id=$responseData['id'];
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
	<div style="width: 200px; margin: 0 auto;">
	<h5>Card Number: 5454545454545454</h5>
	<h5>Expiry Date: 01/30</h5>
	<h5>Card holder: Ankit</h5>
	<h5>CVV        : 12</h5>
   </div>
    <form action="http://localhost/peachpayment/pay.php?user_id=1" class="paymentWidgets" data-brands="VISA MASTER AMEX">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript"> 
      
        var JSLink = "<?php echo $paymentURL; ?>/v1/paymentWidgets.js?checkoutId=<?php echo $checkout_id; ?>";
        var JSElement = document.createElement('script');
        JSElement.src = JSLink;
        //JSElement.onload = OnceLoaded;
        document.getElementsByTagName('head')[0].appendChild(JSElement);


    </script>
</body>
</html>
