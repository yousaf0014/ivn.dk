<html>
<head>
<title>Honda Inventory</title>
</head>
<body>
<?php 

	require 'localhost_email/PHPMailerAutoload.php';
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED) ;
	
	$mail = new PHPMailer;
	// Enable verbose debug output
	$mail->SMTPDebug = 3;                               
	//Set PHPMailer to use SMTP.
	
	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  			// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'ddskioskinventory@gmail.com';   // SMTP username
	$mail->Password = 'DDSki0sk123';        // SMTP password
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';                 // TCP port to connect to
	$mail->SMTPDebug = 0;
?>
<?php

	//$email 	= 'todd@ddsmail.co';
	//$email 	= 'developmentzeast@gmail.com';
	$email = 'i.leads@wayneakers.com';
    
	$first_name = $_POST['fname'];
	$last_name 	= $_POST['lname'];
	$email_user = $_POST['email'];
	$phone 		= $_POST['phone'];
	$comment 	= $_POST['comment'];
	$make 		= $_POST['make'];
	$model 		= $_POST['model'];
	$vin_id 	= $_POST['vin_id'];
	
	
	$mail->setFrom('ddskioskinventory@gmail.com', 'kiosk Kiosk Inventory Lead');
	$mail->addAddress('scholfieldhondaeast@eleadtrack.net', 'Kiosk Inventory Lead');     // Add a recipient
	$mail->addReplyTo('ddskioskinventory@gmail.com', 'Kiosk Inventory Lead');
	$mail->isHTML(true);                                  // Set email format to HTML
	$message=  "<h3>First Name:</h3> ". $first_name . "</br><h3> Last Name:</h3> ".$last_name."</br><h3> Email Address: </h3>".$email_user ."</br><h3> Phone No: </h3>".$phone ."</br> <h3>Comment: </h3>".$comment.'</br><h3>Requested Vehcile:</h3>'.$make.' '.$model.
'</br><h3>Requested Vehcile VIN: </h3>'.$vin_id;

	$mail->Subject = 'Digital Dealership | Honda Inventory';
	$mail->Body    = $message;
	$mail->AltBody = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Email has been sent';
}
?>

</body>
</html>
