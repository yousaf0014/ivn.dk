<?php session_start();
unset($_SESSION['REAL_REFERER']);
	if(isset($_SESSION['why_orange_login'])){
		unset($_SESSION['username']);
		unset($_SESSION['why_orange_login']);
			logout_user();
	}
function logout_user(){
	session_destroy();
	echo'<script type="text/javascript">window.location = "../index.php"</script>';
}
?>
   