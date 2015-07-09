<?php
	if ( $this->input->post("value") !=null  )
	{
			$MerchantID = '0164205';
		
			$Password = 'Mnfe2QYSS';
		
			$Price = $this->input->post("value"); //Price By Toman
		 
			$ReturnPath = base_url("index.php/pages/view/verify");
		
			$ResNumber = 1234 ;// Order Id In Your System
			$Description = 'جزئیات سفارش';
			$Paymenter = $id=get_cookie("name");
			$Email = $id=get_cookie("username");
			$Mobile = '09112403211';
		
			$client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');
		
			$res = $client->RequestPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price, "ReturnPath" =>$ReturnPath, "ResNumber" =>$ResNumber, "Description" =>$Description, "Paymenter" =>$Paymenter, "Email" =>$Email, "Mobile" =>$Mobile));
		
			$PayPath = $res->RequestPaymentResult->PaymentPath;
			$Status = $res->RequestPaymentResult->ResultStatus;
			
			if($Status == 'Succeed')
			{
		
				echo "<html><head><title>Connecting ....</title><head><body onload=\"javascript:window.location='$PayPath'\" style=\"font-family:tahoma; text-align:center;font-waight:bold;direction:rtl\">درحال اتصال به درگاه پرداخت پارس پال ...</body></html>"; 
			}
			else
			{
				echo $Status; 
			}
	}else{
		header("location:".base_url("index.php/pages/view/credit"));
	}

	?>