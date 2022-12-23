<?php require_once('libs/configuration.php'); ?>
<?php require_once('libs/function.php'); ?>
<?php 
if(isset($_GET['p'])){
	$reset_password_code = mysql_real_escape_string($_GET['p']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>IVN</title>
<meta charset="utf-8">
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

<!--Theme Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<!--/Theme Font-->
<!--Javascript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--/Javascript-->
</head>
<body>
<!--Nav-->
<nav class="navbar navbar-inverse col-lg-12">
  <div class="avoid_opacity">
    <div class="container-fluid">
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
          <li>
          <?php if(empty($profile_image)):
			  	/*echo '<img src="assets/images/avatar_place_holder.png" width="44px"
					style="height:44px; margin-right:-18px"  class="login-avatar">';*/
			
		   else: ?> <img src='<?php echo $profile_image?>' class='login-avatar' style="height:44px; margin-right:-10px" /><?php endif; ?>
          <li class="dropdown dropdown-submenu">
          <a href="#" class="dropdown-toggle">
        	        <?php echo $f_name.' '.$l_name; ?>
           <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
          	<ul class="dropdown-menu">
            	<li><a href="profile.php">My Profile</a></li>
                <li><a href="libs/logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
        <?php }else{
		echo '<ul class="nav navbar-nav navbar-right">
          <li><a href="#login">Login</a></li></ul>';
		}?>
		<?php if(isset($_SESSION['why_orange_login'])){ ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="active.php">Hjem</a></li>
          <li><a href="guide.php">Guides</a></li>
          <li><a href="news.php">Nyheder</a></li>
          <li><a href="adecco.php">Adecco</a></li>
        </ul>
        <?php } ?>
       
      </div>
    </div>
  </div>
</nav>
<!--/nav-->
<!--Slider-->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	
  <!-- Indicators -->
    <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" ></li>
    <li data-target="#myCarousel" data-slide-to="1"class="active"></li>
    </ol>
	<!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
    	
    
        <div class="item  slide-1">
        <div class="container">
			<div class="slider-box desktop">
        		<h1 class="text-center no-margin">Vi samler landets iværksættere</h1>
                <p class="m-t-10">Lorem ipsum dolor sit amet, consectetur adi-piscing elit. Fusce quis lectus quis sem lacinia nonummy.  
                Proin mollis lorem non</p>
                <img src="assets/images/slider-overlay-box.png" class="slider-box-img" />
       		</div>
        </div>
        <div class="fill mobile" style="background-image:url('assets/images/slider-1.png');"></div>
         <img src="assets/images/slider-1.png" class="desktop" style="    height: 551px;"/>
        </div>
    
        <div class="item active slide-2">
			<div class="fill mobile" style="background-image:url('assets/images/slider-2.png');"></div>
         <img src="assets/images/slider-2.png" class="desktop" style="    height: 551px;"/>
         <h1 class="slider-heading col-lg-12 col-xs-12 col-sm-12 col-md-12">
         	Velkommen til IVN.dk</br>Danmarks største iværksætternetværk</h1>
        </div>
    
    </div>
	<!--Slider Controls-->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
           	<span class="left-arrow"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="right-arrow"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            <span class="sr-only">Next</span>
        </a>
  <!--/Slider Controls-->
	</div>

<!--Access Section-->
<section>
    <div class="container">    
      <div class="row">
        <!--Reset-->
        <div class="col-sm-12 col-lg-6 col-lg-offset-3  m-t-65">
                <div class="access-wrapper dark-grey" style="min-height:200px; height:auto;">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <label style="display:none">
                            <input type="checkbox" value="" id="terms" checked>
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Ja, jeg accepterer 
                            <a href="#" data-toggle="modal" data-target="#terms-conditions">Brugerbetingelserne</a>
                       </label>
                    	<h1 class="text-center">Indtast et nyt password</h1>
                        <div class="sign-up-form">
                            
                            <div class="row m-t-20">
                                <div class="col-lg-5">
                                    <p>Adgangskode*:</p>
                                </div>
                                <div class="col-lg-7">
                                <input type="hidden" id="action" name="action" value="Update_PASS">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="pull-right form-feedback" id="result">Minimum otte tegn.</small>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-lg-5">
                                    <p>Bekræft adgangskode*:</p>
                                </div>
                                <div class="col-lg-7">
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                    <small class="pull-right form-feedback" id="confirm_result">Minimum otte tegn.</small>
                                    
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                                	<input type="hidden" id="v_pass" name="v_pass" value="<?php echo $reset_password_code ?>">
                                    <button type="submit" class="btn btn-primary col-lg-12">
                                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ja, opret profil</button>
                                </div>
                            </div>   
                        <div class="clearfix"></div>
                    </div><!--/Signup-->
               	 </form>
        	</div><!--access wrapper-->
      </div>
        <!--/Login-->
        
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->
<!--Home  Intro Section-->
<section class="m-t-65">
	<div class="container-fluid light-grey tp-padding">
    	<div class="container text-center">
        	<div class="row">
            	<div class="col-lg-8 col-lg-offset-2">
                	<h1>Lorem ipsum dolor sit amet consectetur</h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis lectus quis sem lacinia  nonummy. Proin mollis lorem non dolor. In hac habitasse platea dictumst.  Phasellus dui. Maecenas facilisis nisl vitae nibh. </h4>
                </div>
            </div>
        </div>
    </div>
</section><!--/Home Intro Section-->

<section>
	<div class="container-fluid ex-dark-grey tp-padding">
    	<div class="container text-center">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h1 style="color:#d0d0ce">Lorem ipsum dolor sit amet consectetur</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Terms and Condition Popup-->
	<?php require_once('libs/terms-and-conditons.php') ?>
<!--/Terms and Condition-->

<!--Forget Password-->
	<?php require_once('libs/forget-password.php'); ?>
<!--/Forget Password-->
<?php }else{
	die('Invalid Link');
}?>
<?php include('footer.php') ?>
