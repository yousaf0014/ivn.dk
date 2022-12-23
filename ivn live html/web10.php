<?php
	
$body = "<p>First Name:Brian Mogensen<br>Email: ingencocio@gmail.com<br>Company Name: das</p>";
$email = "support@talkactive.net";
$html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>IVN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>'.$body.'</body>
</html>';
    
    
$messageid = '<testasdfasfd@smtp.web10.net>';
     
    
 require_once "Mail.php";
 require_once 'Mail/mime.php' ;

 $host = "mail.web10.net";
 $port = 587;
 $username = 'no-reply@ivn.dk';
 $password = 'WhyOrange4';

 $headers = array ( 'From' => $username, 
 					'To' => $email, 
 					'Subject' => "test fra web10", 
 					'Date' => date('r', time()),
 					"Content-Type" => "multipart/alternative; charset=UTF-8","MIME-Version" => "1.0");

 // $headers = array ('From' => $username, 
 // 				   'To' => $email, 
 // 				   'Subject' => "test fra web10", 
 // 				   'Date' => date('r', time()),"Content-Type" => "multipart/alternative; charset=UTF-8");
 
 $smtp = Mail::factory('smtp',
		 array (
			 'host' => $host,
			 'port'=>$port,
			 'auth' => true,
			 'username' => $username,
			 'password' => $password,
			 'localhost' => 'mail.web10.net')
		 );
 
 $mime = new Mail_mime(array('eol' => $crlf));
 $mime->setTXTBody(strip_tags($body));
 $mime->setHTMLBody($html);
 $body = $mime->get();
 $headers = $mime->headers($headers);
 $mail = $smtp->send($email, $headers, $body);
 
	if (PEAR::isError($mail)) {
    	die(EMAIL_ERROR);
 	} else {
      die($okmessage);
 	}
	
?>