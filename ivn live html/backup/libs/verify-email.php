<?php include("configuration.php")?>
<?php include("function.php")?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

	<?php if(isset($_GET['q'])){
			$ver_token = mysql_real_escape_string($_GET['q']);
			$check_token   = get_row("users"," where  `users`.`verification_token` = '$ver_token'");
				if(mysql_num_rows($check_token) > 0){
						$verify_data = array(
								'verified' => 1,
								'updated' => date('Y-m-d H:i:s')
							);
							if(dbRowUpdate("users",$verify_data,"verification_token ='$ver_token'")){
									/*echo ("<SCRIPT LANGUAGE='JavaScript'>
												  window.location.href='../index.php?verify='Your Email Is Verified'';
											</SCRIPT>");
											*/
											echo 'Updated';
							}else{
								die('Not able to verify your email.');
							}
				}else{
					die('</br>Invalid Link');
				}
	}
		if(isset($_GET['p'])){
			echo 'AO GE';
		}
	?>