<?php
 session_set_cookie_params ((14 * 24 * 60 * 60),  '/', '.ivn.dk');
?>                                                                       
<?php session_start(); ?>
<?php require_once('libs/configuration.php'); ?>
<?php require_once('libs/function.php'); ?>
<?php //echo $_SERVER['REQUEST_URI'];
	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		if(isset($_SESSION['why_orange_login'])){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.location.href='active.php';
			</SCRIPT>");
		}
	}else{
		 if(!isset($_SESSION['why_orange_login'])){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='index.php';
					</SCRIPT>");
		}
	}
	
?>
<!DOCTYPE html>
<html lang="da">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>IVN.dk - Iv&aelig;rks&aelig;tter Netv&aelig;rk </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--CSS-->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/ivn-theme.css" type="text/css">
<!--<link rel="stylesheet" href="assets/css/ivn-theme.min.css" type="text/css">-->
<!--/CSS-->
<!--Plugin-->
<!--Import Multi Step Indicator css-->
<link href="assets/plugin/tabs/css/gsi-step-indicator.min.css" rel="stylesheet" />

<!--Import  Step Form Wizard css-->
<link href="assets/plugin/tabs/css/tsf-step-form-wizard.min.css" rel="stylesheet" />

<!--Slider-->
<!--<link rel="stylesheet" href="assets/plugin/slider/css/swiper.css">-->
<link rel="stylesheet" href="assets/plugin/slider/css/swiper.min.css">

<!--Theme Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<!--/Theme Font-->
<!--Javascript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--/Javascript-->
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-22368804-4', 'auto');
  ga('send', 'pageview');
</script>
<script type="text/javascript">
function sendbuttonTrack(cat,action,labal){
  ga( 'send', 'event', 'button Click', 'submit' );
}
function sendbuttonTrack1(cat,action,labal){  
  ga('send', 'event', { eventCategory: cat, eventAction: action, eventLabel: labal});
}
</script>
<!--Nav-->
<nav class="navbar navbar-inverse col-lg-12">
  <div class="avoid_opacity">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="index.php">IVN</a> </div>
      <div class="collapse navbar-collapse" id="myNavbar">
         <?php if(isset($_SESSION['why_orange_login'])){ ?>
          <?php  $login_data =  get_row('users','where id = '. $_SESSION['user_id']);
					$row = mysql_fetch_assoc($login_data);
						//user information
						$f_name 	= $row['firstname'];
						$l_name			= $row['lastname'];
						$profile_image	= $row['profile_image'];
						
					?>
                      
        <ul class="nav navbar-nav navbar-right">
          
         <li class="mobile-avatar">
          <?php if(!empty($profile_image)):?>
          <div class="profile_avatar desktop" style="background:url(<?php echo $profile_image?>)"></div>
                
                <!--<p class="mobile"> <img src='<?php echo $profile_image?>' class='login-avatar' style="height:44px;" />			  	-->
                <p class="mobile"> <img src='<?php echo $profile_image?>' class='login-avatar'  style="object-fit: cover;width: 44px;height: 44px;"/>
                <?php echo $f_name.' '.$l_name; ?></p><?php endif; ?>
                <?php if(empty($profile_image)){
						echo '<p class="mobile">'.$f_name.' '.$l_name.'</p>';
					
				}?>
         </li> 
         <li class="dropdown dropdown-submenu desktop">
          <a href="#" class="dropdown-toggle">
        	        <?php echo $f_name.' '.$l_name; ?>
           <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
          	<ul class="dropdown-menu">
            	<li><a href="profile.php">Min profil</a></li>
                <li><a href="libs/logout.php">Log ud</a></li>
            </ul>
          </li>
        </ul>
        <?php }else{
		echo '<ul class="nav navbar-nav navbar-right">';?>
          <li><a href="javascript:void(0)" id="d_login">Login</a></li></ul>
	<?php	}?>
		<?php if(isset($_SESSION['why_orange_login'])){ ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="active.php">Forside</a></li>
          <li class="dropdown dropdown-submenu"><a href="javascript:void(0)" class="dropdown-toggle">Medlemsfordele
          <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu regular_drop_down">
              
                <li><a href="lasertryk.php">Billige tryksager</a></li>
                <li><a href="bogtilbud.php">Bogtilbud</a></li>
                <li><a href="virtuel-salgschef.php">Virtuel Salgschef</a></li>
                <li><a href="gratis-advokatraadgivning.php">Gratis Advokatrådgivning</a></li>
                <li><a href="finansiering-af-ivaerksaettere.php">Finansiering af Iværksættere</a></li>
                <li><a href="betaling-paa-nettet.php">Betaling på nettet</a></li>
                <li><a href="faa-en-pris-paa-web-loesninger.php">Få tilbud på web-løsninger</a></li>
                
            </ul>
          </li>
         
          

          <li><a href="kontakt-os.php">Kontakt os</a></li>						               
        </ul>
        <ul class="nav navbar-nav navbar-right mobile">
          <li><a href="profile.php">Min profil</a></li>
          <li><a href="libs/logout.php">Log ud</a></li>
        </ul>
        
        <?php } ?>
       
      </div>
    </div>
  </div>
</nav>
<!--/nav-->