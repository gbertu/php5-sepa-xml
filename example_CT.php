<?php
require_once("SEPASCT.php");
$config = array("name" => "Test",
                "IBAN" => "NL41BANK1234567890",
                //"BIC" => "BANKNL2A", <- Optional, banks may disallow BIC in future
                "batch" => True,
                "debitor_id" => "00000",
                "currency" => "EUR",
                //"validate" => False, <- Optional, will disable internal validation of BIC and IBAN.
				"version" => "3"
                );
                
$payment = array("name" => "Test von Testenstein",
                 "IBAN" => "NL40BANK1234567890",
                 //"BIC" => "BANKNL2A", <- Optional, banks may disallow BIC in future
                 "amount" => "1000",
                 "execution_date" => date("Y-m-d"),
                 "description" => "Test transaction"
                );      

try{
    $SEPASCT = new SEPASCT($config);
    $SEPASCT->addPayment($payment);
    $xml = $SEPASCT->save();
    
    if($SEPASCT->validate($xml)){
		print_r($xml);
	}else{
		print_r($SEPASCT->validate($xml));
	}
	print_r($SEPASCT->getCreditTransferInfo());
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}

?>
