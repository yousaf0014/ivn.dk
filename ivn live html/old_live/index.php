<?php session_start (); include('header.php') ?>
<?php require_once 'fbConfig.php'; ?>

<!--Slider-->
<input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>" />

<?php 
if(basename($_SERVER['HTTP_REFERER'])!='logout.php'){
    $_SESSION['REAL_REFERER'] = $_SERVER['HTTP_REFERER'];    
}
?>
<?php $fb_login  = false; ?>
<?php if(isset($accessToken)){

    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
        // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirect the user back to the same page if url has "code" parameter in query string
    if(isset($_GET['code'])){
        header('Location: ./');
    }
    
    // Getting user facebook profile info
    try {
        $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
        $fbUserProfile = $profileRequest->getGraphNode()->asArray();


    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirect user back to app login page
        header("Location: ./");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    $fb_login  = true;
}
?>

<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
             <div class="item active slide-2 animated slideInRight">
                <div class="fill mobile" style="background-image:url('assets/images/slider-2.jpg');"></div>
                <img src="assets/images/slider-2.jpg" class="desktop" style="    height: 551px;"/>
                <h1 class="slider-heading col-lg-12 col-xs-12 col-sm-12 col-md-12">
                    Velkommen til IVN.dk<br>Danmarks st&oslash;rste iv&aelig;rks&aelig;tternetv&aelig;rk</h1>
            </div>
        </div>
        <div class="swiper-slide"> 
                    <div class="item  slide-1 animated slideInRight">
            <div class="container" style="position:relative;">
                <div class="slider-box desktop">
                    <h1 class="no-margin">40.000 medlemmer kan ikke tage fejl</h1>
                    <p class="m-t-10">IVN er Danmarks st&oslash;rste community for iv&aelig;rks&aelig;ttere, og vi vokser hele tiden.</p>
                    <img src="assets/images/active-slider-box.png" class="slider-box-img" />
                 <div class="clearfix"></div>
                </div>
               
            </div>
            <div class="fill mobile" style="background-image:url('assets/images/slider-1.jpg');"></div>
                <a href="#"data-toggle="modal" data-target="#site_guide" data-keyboard="true"> 
                    <img src="assets/images/slider-1.jpg" class="desktop" style="    height: 551px;"/>
               </a>
            </div>

        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
    
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div></div>
<!--Home  Intro Section-->
<section>
    <div class="container-fluid  tp-padding-30">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1">
                    <h4 style="margin: 0px;">IVN.dk er det naturlige n&aelig;ste skridt i udviklingen af Iv&aelig;rks&aelig;tter Netv&aelig;rk. <br>40.000 medlemmer giver de bedst mulige vilk&aring;r for at skabe en platform, der d&aelig;kker alle iv&aelig;rks&aelig;tteriets behov.  <br>Opret din personlige profil i dag og v&aelig;r med til at forme IVN.dk.</h4>
                    
                </div>
            </div>
        </div>
    </div>
</section><!--/Home Intro Section-->
<?php 
    if(!$fb_login){
        include('AccessSection.php');
    }else{
        require_once('libs/configuration.php');
            //check existing email
        $fb_email = $fbUserProfile['email'];
        $fb_fname = $fbUserProfile['first_name'];
        $fb_lname = $fbUserProfile['last_name'];
        
        $sql = "select * from users where email = '$fb_email'";
        $qry = mysql_query($sql)or die(mysql_error());
        $res = mysql_fetch_assoc($qry);
        $firstname  = $res['firstname'];
        $lastname   = $res['lastname'];
        $last_id    = $res['id'];
        $user_token = $res['user_token'];
        
            if(mysql_num_rows($qry)>0){
               // session_start();
                $_SESSION["why_orange_login"]   = true;
                $_SESSION["username"]           = $firstname.' '.$lastname;
                $_SESSION['user_id']            = $last_id;
                $_SESSION['user_toekn']         = $user_token;
                
                $referer = '';
                if (isset($_SESSION['REAL_REFERER'])) {
                    $referer = $_SESSION['REAL_REFERER'];
                    unset($_SESSION['REAL_REFERER']);
                }
                else {
                    $referer = $_SERVER['HTTP_REFERER'];
                }
                
                echo 'Du er nu logget ind';
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                       window.location.href='$referer';
                       </SCRIPT>");
            }else{
                
                $intermediateSalt = md5(uniqid(rand(), true));
                $salt = substr($intermediateSalt, 0, MAX_LENGTH);
                $user_token = hash("sha256", $fb_email . $salt);
                $form_data = array(
                            'firstname' => $fb_fname,
                            'lastname' => $fb_lname,
                            'gender_id' => 3,
                            'email' => $fb_email,
                            'userjobstatus_id' => 4,
                            'entrepreneurial_status_id' => 4,
                            'user_type_id' => 3,
                            'verified' => 1,
                            'password_hash'=>md5(uniqid(rand(), true)),
                            'password_salt'=>md5(uniqid(rand(), true)),
                            'active' => 1,
                            'user_token'=>$user_token,
                            'created' => date('Y-m-d H:i:s')
                    );
                    $fields = array_keys($form_data);
                    $sql = "insert INTO users  (`".implode('`,`', $fields)."`)
                            VALUES('".implode("','", $form_data)."')";

                    if(mysql_query($sql)){
                            session_start();
                            $_SESSION["why_orange_login"]   = true;
                            $_SESSION["username"]           = $firstname.' '.$lastname;
                            $_SESSION['user_id']            = $last_id;
                            $_SESSION['user_toekn']         = $user_token;
                            
                            $referer = '';
                            if (isset($_SESSION['REAL_REFERER'])) {
                                $referer = $_SESSION['REAL_REFERER'];
                                unset($_SESSION['REAL_REFERER']);
                            }
                            else {
                                $referer = $_SERVER['HTTP_REFERER'];
                            }
                            
                            echo 'Du er nu logget ind';
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                                   window.location.href='$referer';
                                   </SCRIPT>");
                    }
                
            }
    }    
   
?>
<section>
    <div class="container-fluid ex-dark-grey tp-padding-30">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h1 style="color:#d0d0ce">Er du iv&aelig;rks&aelig;tter?</h1>
                    <h4>Med 40.000 medlemmer er IVN.dk den mest fyldestg&oslash;rende platform for alt, der har med iv&aelig;rks&aelig;tteri at g&oslash;re.</h4>
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
<!--Site Guide Popup-->
    <?php require_once('libs/site_guide_popup.php') ?>
<!--/Site Guide Popup-->
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $('head').append('<meta name="description" content="IVN.dk er det n�ste skridt for facebook gruppen Iv�rks�tter Netv�rk. 40.000 medlemmer giver de bedst mulige vilk�r for at skabe en platform, der d�kker alle iv�rks�tteriets behov. Opret din personlige profil i dag og v�r med til at forme IVN.dk.">');
        $('head').append('<meta name="keywords" content="Iv�rks�tter, iv�rks�ttere, iv�rks�tteri, forretninger, start-up,virksomhedsopstart, Iv�rks�tter Netv�rk, netv�rk, networking">');
    });
</script>
