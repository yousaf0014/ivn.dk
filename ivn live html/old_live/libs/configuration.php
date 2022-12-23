<?php
	$DB_HOST 	= 'mysql67.unoeuro.com';
	$DB_USER 	= 'ivn_dk';
	$DB_NAME	= 'ivn_dk_db2';
	$DB_PASS	= 'WhyOrange4';

 // 	$DB_HOST 	= 'localhost';
	// $DB_USER 	= 'root';
	// $DB_NAME		= 'ivn';
	// $DB_PASS		= 'root';
	
        /* Site URL without Admin Path */
	$SITE_URL = 'http://ivn.dk/';
	
	// Create connection
		$connection = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
		mysql_set_charset('utf8', $connection);
		//Check Connection
		if(!mysql_select_db($DB_NAME,$connection)){

			die("<h1>Database Connection error </h1>");
		}
		//Check Site Url
		if($SITE_URL==''){
			die('Site URL field empty');
		}
?>