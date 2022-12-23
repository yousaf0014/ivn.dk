<?php
	$DB_HOST 	= 'db.ivn.dk';
	$DB_USER 	= 'web780228';
	$DB_NAME	= 'web780228_1';
	$DB_PASS	= 'WhyOrange4';
	
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