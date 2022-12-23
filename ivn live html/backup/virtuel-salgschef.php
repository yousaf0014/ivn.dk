<?php include('header.php') ?>
<!--Slider-->
<section>

        <div class="fill mobile" style="background-image:url('assets/images/ivn-virtuel-salgschef.jpg');"></div>
        <div class="desktop"><img src="assets/images/ivn-virtuel-salgschef.jpg" style="max-height:551px;"/></div>
</section>

<!--Access Section-->
<section>
    <div class="container">    
      <div class="row">
        	<div class="col-lg-12 text-center">
            	<h1>F&aring; en virtuel salgschef gratis i en m&aring;ned</h1>
            </div>
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->    

<!--Logedin Home Page-->
<section class="offwhite">
<div class="container">
		<div class="row tp-padding">
        	<div class="col-lg-7 col-md-7 col-sm-12">
					<p>Nu kan du skabe bedre salgsresultater med professionel sparring. Jacob Handberg tilbyder salgsm&oslash;der, der gennemg&aring;r salget hos din virksomhed grundigt, s&aring; du b&aring;de f&aring;r l&oslash;sninger p&aring; udfordringer nu og her, og en bedre id&eacute; om, hvordan du skal m&aring;lrette salget fremad.
					<br><br>
					Med den virtuelle salgschef modtager du et m&aring;nedligt salgsm&oslash;de, hvor en fast agenda gennemg&aring;s: </p>
				<div class="col-lg-12 col-lg-offset-1 col-xs-12 xs-t-20">
					 <ul>
					  <li>M&aring;nedens salgsindex<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hvor langt er vi i forhold til vores budget</li>
					   <br><li>Min st&oslash;rste udfordring<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hvilke udfordringer oplever du i dit salgsarbejde</li>
					   <br>
					   <li>Mit bedste salg - m&aring;nedens succeshistorie<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En deltager deler sin bedste salgsoplevelse til inspiration for alle</li>
					   <br>
					   <li>M&aring;nedens tema fra v&aelig;rkt&oslash;jskassen<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vi dykker ned i v&aelig;rkt&oslash;jskassen og tr&aelig;ner et specifikt emne</li>
					</ul>
				</div>
				<p>Deltag i det f&oslash;rste salgsm&oslash;de gratis og oplev hvor meget v&aelig;rdi det giver dig. Tilmeld dig i boksen.</p>
			</div>
       <div class="col-sm-12 col-lg-5 col-md-5 mobile_margin_top">
        <div class="login_point" id="login"></div>
                <div class="subscribe-wrapper dark-grey">
                	<?php 
					$profile_data =  get_row('users','where id = '. $_SESSION['user_id']);
							$data = mysql_fetch_assoc($profile_data);
							//user information
								$first_name 	= $data['firstname'];
								$last_name 		= $data['lastname'];
								$email			= $data['email'];
					?>
                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="sign-up-form">
                    <h3 style="margin-bottom: 0px;">Tilmelding</h3>
                    <p>Pr&oslash;v det f&oslash;rste salgsm&oslash;de gratis.</p>
                   
                                <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Fulde navn*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_name" id="sub_name"  value="<?php echo $first_name.' '.$last_name ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="SUBSCRIBE"/>
                            <div class="col-lg-4">
                                <p>Email*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_email" id="sub_email" 
                                value="<?php echo $email ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                           <?php
								$sql 			= get_row('company','where users_id = '. $_SESSION['user_id']);
								$company_data   = mysql_fetch_assoc($sql);
								$company_name 	= $company_data['name'];
								$has_company = false;
								if(mysql_num_rows($sql) > 0){
									$has_company = true;
								}
									
							?>
                            <div class="col-lg-4">
                                <p>Virksomhed*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_company" id="sub_company" value="<?php echo $company_name ?>" >
                                </div>
                            <input type="hidden" name="has_company" id="has_company" value="<?php echo $has_company ?>"/>
                        </div>
                        <div class="row m-t-20">
							<p style="margin-top: 0px;">Felter markeret med * skal udfyldes</p><br>
                        	<div class="col-lg-8 col-lg-offset-2">
                            	<button type="submit" class="btn btn-primary col-lg-12">
                                	Ja tak, jeg vil gerne tilmeldes
                                </button>
                            </div>
                            
                     </div>
                          <div class="row m-t-20 text-center">
							  <p style="width: 95%;margin: 0 auto;">N&aring;r du tilmelder dig, s&aring; modtager du en mail med mere information om hvordan du kommer med p&aring; salgsm&oslash;det. Du forpligter dig ikke til at k&oslash;be noget, men accepterer at modtage emails fra salgschef.dk</p>
                         <br>
                          </div>
                           
                    <div class="clearfix"></div>
                </div><!--/Signup-->
                </form>
        </div><!--access wrapper-->
      </div>
        </div>
</div>
</section>
<!--Logedin Home Page-->
<section>
	<div class="container-fluid ex-dark-grey tp-padding">
    	<div class="container text-center">
            <div class="row" >
                <div class="col-lg-10 col-lg-offset-1">
                    <h1 style="margin-bottom: 0px;">Den virtuelle salgschef tilbyder dig m&aring;nedlig salgssparring, der hj&aelig;lper dig videre til resultater</h1>  <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN.dk | Virtuel Salgschef ');
        $('head').append('<meta name="description" content="Med den virtuelle salgschef får du kyndig rådgivning af en kompetent og erfaren salgschef, der kan hjælpe dig videre i salgsprocessen. Det månedslige salgsmøde kan være med til at øge salget her og nu og få skabt en holdbar salgsplan for fremtiden.">');
        $('head').append('<meta name="keywords" content="Virtuel salgschef, salg, salgschef, øget salg, forbedret salg, salgsmøde, møde, sælger, gratis">');
    });
</script>