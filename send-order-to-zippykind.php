<?php
/*
Please refer to Zippykind's API documentation for more information https://apidocs.zippykind.com

Since this code will generate a delivery ticket that you will be charged for in your Zippykind account, we suggest adding a Google reCaptcha code to this php page and to your form.  A Google reCaptcha will help stop bots from submitting the form without your permission.  More information on Google reCaptcha can be found here https://www.google.com/recaptcha/intro/.

You can create an API key by clicking on API Keys from the main menu of your Zippykind account.

This code is provided as is and Zippykind doesn't provide any warranties to the usability, security or functionality of this code.

*/
$apiKey='YOUR_API_KEY';
$curl = curl_init();

// Example of hardcoded order data.
/*
$order = array(
	'trans_type'=>'delivery',
	'customer_name'=>'John Doe',
	'email_address'=>'johndoe@gmail.com',
	'contact_number'=>'14804777931', // Prepend the country code to the phone number and don't include any special characters.
	'ticket_description'=>'test description',
	'ext_invoice_number'=>'INV1029',
	'delivery_fee'=>'5',
	'total'=>'25',
	'product_pickup_lat'=>'33.494740',
	'product_pickup_lng'=>'-111.926407',
	'product_pickup_address'=>'4032 N Scottsdale Rd, Scottsdale, AZ 85251',
	'product_pickup_contact_number'=>'14802223333',
	'ticket_lat'=>'33.488960',
	'ticket_lng'=>'-111.927340',
	'delivery_address'=>'3530 N Goldwater Blvd, Scottsdale, AZ 85251',
	'delivery_date'=>'2019-10-30 18:22:11', // YYYY-MM-DD HH:MM:SS format
	'order_items'=> array(
		array(
			'product_name'=>'Cheeseburger',
			'sub_total'=>'14.95',
			'quantity'=>'1'
		),
		array(
			'product_name'=>'Coca Cola',
			'sub_total'=>'2.95',
			'quantity'=>'2'
		),	
	)
	
);
$params='scope=newTicket';
$params.='&trans_type='.$order['trans_type'];
$params.='&customer_name='.$order['customer_name'];
$params.='&email_address='.$order['email_address'];
$params.='&contact_number='.$order['contact_number'];
$params.='&ticket_description='.$order['ticket_description'];
$params.='&ext_invoice_number='.$order['ext_invoice_number'];
$params.='&delivery_fee='.$order['delivery_fee'];
$params.='&total='.$order['total'];
$params.='&product_pickup_lat='.$order['product_pickup_lat'];
$params.='&product_pickup_lng='.$order['product_pickup_lng'];
$params.='&product_pickup_address='.$order['product_pickup_address'];
$params.='&product_pickup_contact_number='.$order['product_pickup_contact_number'];
$params.='&ticket_lat='.$order['ticket_lat'];
$params.='&ticket_lng='.$order['ticket_lng'];
$params.='&delivery_address='.$order['delivery_address'];
$params.='&delivery_date='.date('Y-m-d h:m');
$params.='&order_items='.json_encode($order['order_items']); 
*/
// End hardcoded order data

// If posting from an HTML form, use the code below.
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
$params.='&order_items='.json_encode($_POST['order_items']); 

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
