<?php include('header.php') ?>
<!--Slider-->
<section style="padding-top:80px;">

        <div class="fill mobile" style="background-image:url('assets/images/ivn-jura.png');"></div>
        <div class="desktop"><img src="assets/images/ivn-jura.png" style="max-height:551px;"/></div>
</section>

<!--Access Section-->
<section>
    <div class="container">    
      <div class="row">
        	<div class="col-lg-12 text-center">
            	<h1>Få en times gratis advokatrådgivning</h1>
            </div>
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->    

<!--Logedin Home Page-->
<section class="offwhite">
<div class="container">
		<div class="row tp-padding">
        	<div class="col-lg-7 col-md-7 col-sm-12">
					<p>Du arbejder på fuldt tryk for at sikre, at din virksomhed har de bedste vilkår for at blive den succes, du ved den kan blive. Når du er i gang med at udleve drømmen om at starte din egen virksomhed, er der rigeligt at holde styr på. </p>
                    <p>Det er dog de færreste, der kan holde styr på alt, og særligt den juridiske del kan være tung at danse med.</p>
                    <p>Derfor har IVN allieret sig med KVIKAdvokat, der specialiserer sig i hurtig og kompetent juridisk rådgivning.</p>
                    <p>Lige nu kan du således få en times gratis rådgivning, omkring netop dine udfordringer.</p>
                    <p>Skriv dig op her på siden, og så vil du blive kontaktet af KVIKAdvokaten indenfor 24 timer.</p>
                    <p>KVIKAdvokat er medlem af Advokatsamfundet og ansvarsforsikret i et godkendt forsikringsselskab. Advokaterne bag har praktiseret i flere årtier, og de arbejder på at levere advokatydelser på et højt fagligt niveau – hurtigt og effektivt. </p>
                    <p>Udover ydelser indenfor selskabsret kan KVIKAdvokat være behjælpelig med rådgivning indenfor lejeret, testamenter, ægtepagter, samejeoverenskomster, ekspedition af køb og salg af boliger m.m, der alle ekspederes digitalt.</p>
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
                    <form action="#" method="post" id="form_c"  enctype="multipart/form-data">
                    <div class="sign-up-form">
                    <h3 style="margin-bottom: 0px;">Tilmelding</h3>
                    
                                <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Fulde navn*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_name" id="sub_name"  value="<?php echo $first_name.' '.$last_name ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="JURA_SUBSCRIBE"/>
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
                            <div class="col-lg-12">
							<p style="margin-top: 0px;">Felter markeret med * skal udfyldes</p><br>
                            </div>
                        	<div class="col-lg-12">
                            	<button type="submit" class="btn btn-primary col-lg-12" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Advokatraadgivning'); $('#form_C').submit();">
                                	Ja tak - jeg vil gerne modtage 1 times gratis rådgivning
                                </button>
                            </div>
                            
                     </div>
                          <div class="row m-t-20 text-center">
							  <p style="width: 95%;margin: 0 auto;">Når du tilmelder dig, vil du få tilsendt en mail omkring yderligere information</p>
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
                    <h1 style="margin-bottom: 0px;">KVIKAdvokat og IVN giver dig svar på dine juridiske spørgsmål. Skriv dig op og så tager vi kontakt til dig snarest.</h1>  <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN.dk | Advokatrådgivning');
        $('head').append('<meta name="description" content="Med den virtuelle salgschef får du kyndig rådgivning af en kompetent og erfaren salgschef, der kan hjælpe dig videre i salgsprocessen. Det månedslige salgsmøde kan være med til at øge salget her og nu og få skabt en holdbar salgsplan for fremtiden.">');
        $('head').append('<meta name="keywords" content="Virtuel salgschef, salg, salgschef, øget salg, forbedret salg, salgsmøde, møde, sælger, gratis">');
    });
</script>