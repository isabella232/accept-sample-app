<?php

// Validation URL is passed in the request
$validationUrl=$_POST['validationUrl'];

// JSON Payload 
$validationPayload = '{"merchantIdentifier":"merchant.authorize.net.test.dev15","domainName":"applepay-sample.azurewebsites.net","displayName":"MyStore"}';
//print_r($validationUrl);
try{	//setting the curl parameters.
        $ch = curl_init();
        if (FALSE === $ch)
        	throw new Exception('failed to initialize');
        curl_setopt($ch, CURLOPT_URL, $validationUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $validationPayload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );        
        $content = curl_exec($ch);
        if (FALSE === $content)
        	throw new Exception(curl_error($ch), curl_errno($ch));
        curl_close($ch);
		echo $content;
		// $content is the Apple Response, it should be a merchant session object
		// but may need to do some manipulation here
		
    }catch(Exception $e) {
    	trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
	}

?>