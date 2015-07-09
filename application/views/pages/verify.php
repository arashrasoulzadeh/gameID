<?php

	$MerchantID = '0164205';

	$Password = 'Mnfe2QYSS';

	$Price = 1000; //Price By Toman
 
	
	if(isset($_POST['status']) && $_POST['status'] == 100){
		$Status = $_POST['status'];

		$Refnumber = $_POST['refnumber'];

		$Resnumber = $_POST['resnumber'];
//Your Order ID

		$client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');

		$res = $client->VerifyPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price,"RefNum" =>$Refnumber ));
	


		
		$Status = $res->verifyPaymentResult->ResultStatus;
		$PayPrice = $res->verifyPaymentResult->PayementedPrice;
		if($Status == 'success')// Your Peyment Code Only This Event
		{
			echo '<div style="color:green; font-family:tahoma; direction:rtl; text-align:right">
			پرداخت با موفقیت انجام شد ، شماره رسید پرداخت : '.$Refnumber.' ،  مبلغ پرداختی : '.$PayPrice.' !
			<br /></div>';
		}else{
			echo '<div style="color:green; font-family:tahoma; direction:rtl; text-align:right">
			خطا در پردازش عملیات پرداخت ، نتیجه پرداخت : '.$Status.' !
			<br /></div>';
		}
	}
	else
	{
		echo '<div style="color:red; font-family:tahoma; direction:rtl; text-align:right">
		بازگشت از عمليات پرداخت، خطا در انجام عملیات پرداخت ( پرداخت ناموق ) !
		<br /></div>';
	};
?>