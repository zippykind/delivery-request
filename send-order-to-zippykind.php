<?php
/*
Please refer to Zippykind's API documentation for more information https://apidocs.zippykind.com

Since this code will generate a delivery ticket that you will be charged for in your Zippykind account, we suggest adding a Google reCaptcha code to this php page and to your form.  A Google reCaptcha will help stop bots from submitting the form without your permission.  More information on Google reCaptcha can be found here https://www.google.com/recaptcha/intro/.

You can create an API key by clicking on API Keys from the main menu of your Zippykind account.

This code is provided as is and Zippykind doesn't provide any warranties to the usability, security or functionality of this code.

*/
$apiKey='YOUR_API_KEY';
$curl = curl_init();

$params='scope=newTicket';
$params.='&trans_type='.$_POST['trans_type'];
$params.='&customer_name='.$_POST['customer_name'];
$params.='&email_address='.$_POST['email_address'];
$params.='&contact_number='.$_POST['contact_number'];
$params.='&ticket_description='.$_POST['ticket_description'];
$params.='&ext_invoice_number='.$_POST['ext_invoice_number'];
$params.='&delivery_fee='.$_POST['delivery_fee'];
$params.='&total='.$_POST['total'];
$params.='&product_pickup_lat='.$_POST['product_pickup_lat'];
$params.='&product_pickup_lng='.$_POST['product_pickup_lng'];
$params.='&product_pickup_address='.$_POST['product_pickup_address'];
$params.='&product_pickup_contact_number='.$_POST['product_pickup_contact_number'];
$params.='&ticket_lat='.$_POST['ticket_lat'];
$params.='&ticket_lng='.$_POST['ticket_lng'];
$params.='&delivery_address='.$_POST['delivery_address'];
$params.='&delivery_date='.date('Y-m-d h:m');

if(!empty($_POST['trans_type'])){	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://zippykind.com/api/v2/",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $params,
	  CURLOPT_HTTPHEADER => array(
		"apikey: ".$apiKey,
		"cache-control: no-cache",
		"Content-Type: application/x-www-form-urlencoded; charset=utf-8",
	  ),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	if ($err) {
	  $response = 'error '.$err;
	} else {
	  $response = 'success '.$response;
	}
} else {
	 $response = 'error';
}
echo json_encode(array('response' => $response)); 
?>