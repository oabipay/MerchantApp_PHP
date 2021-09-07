
	<?php 
	
	
	   include ("../libfiles/iPayOabPipe.php");
		try {

			$currency	= "512";
 			$language	= "ENG";
 			$receiptURL	= "http://localhost/oabPhpPlain_7x/bankHosted/HostedPaymentResult.php";
 			$errorURL	= "http://localhost/oabPhpPlain_7x/bankHosted/HostedPaymentResult.php";
			$resourcePath = "C:\\xampp\\htdocs\\oabPhpPlain_7x\\cgnFiles\\sha\\";
			$aliasName = "SHAH2020";
			$myObj = new iPayOabPipe();
			$myObj->setResourcePath(trim($resourcePath));
			$myObj->setKeystorePath(trim($resourcePath));
			$myObj->setAlias(trim($aliasName));
			$myObj->setCurrency(trim($currency));
			$myObj->setLanguage(trim($language));
			$myObj->setResponseURL(trim($receiptURL));
			$myObj->setErrorURL(trim($errorURL));

			$myObj->setAction(trim($_POST['action']));
			$myObj->setAmt($_POST['amount']);
			$myObj->setTrackId($_POST['trackId']);
			$myObj->setUdf1($_POST['udf1']);
			$myObj->setUdf2($_POST['udf2']);
			$myObj->setUdf3($_POST['udf3']);
			$myObj->setUdf4($_POST['udf4']);
			$myObj->setUdf5($_POST['udf5']);
			
			if(trim($_POST['tokennumber']) != null && trim($_POST['tokennumber']) != ''){
				$myObj->settokenNumber(trim($_POST['tokennumber']));
				$myObj->settokenFlg('2');
			}
			$result = $myObj->performPaymentInitializationHTTP();
			if(trim($result) == 0) {
				$url=$myObj->getWebAddress();
			} else {
				$url = $myObj->getErrorURL()."?ErrorText=".$myObj->getError();
			}
			header( 'Location:'.$url ) ;
		} catch(Exception $e) {
			echo 'Message: ' .$e->getFile();
	  		echo 'Message1 : ' .$e->getCode();
		}
		
	?>
	
