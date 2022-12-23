<?php include('header.php') ?>
<!--Slider-->
<section style="padding-top:80px;">

        <div class="fill mobile" style="background-image:url('assets/images/ivn-online-betaling.jpg');"></div>
        <div class="desktop"><img src="assets/images/ivn-online-betaling.jpg" style="max-height:551px;"/></div>
</section>

<!--Access Section-->
<section>
    <div class="container">    
      <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Saml dine online betalinger ét sted</h1>
            </div>
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->    

<!--Logedin Home Page-->
<section class="offwhite">
<div class="container">
        <div class="row tp-padding">
            <div class="col-lg-7 col-md-7 col-sm-12">
                    <p>PensoPay har samlet betaling og indløsning i én løsning. På denne måde får du nemt og hurtigt en enkel og
                    sikker løsning, der kan installeres på de mest gængse webshop-løsninger. Mere end 40 plug-an-play
                    moduler sikrer, at din webshop kan kobles på løsningen uden store ændringer.
                    <br><br>
                    PensoPay understøtter betaling via:</p>
                    
                <div class="col-lg-6">
                 <br>
                    <ul>
                      <li>Dankort</li>
                       <li>Visa/Dankort </li>
                       <li>Visa</li>
                       <li>VisaElectron</li>
                       <li>Mastercard</li>
                       <li>Mastercard debit </li>
                    </ul>
                     <br>
                </div>
                <div class="col-lg-6">
                 <br>
                    <ul>
                        <li>Maestro</li>
                        <li>MobilePay</li>
                        <li>Klarna</li>
                        <li>ViaBill</li>
                        <li>Sofort</li>
                        <li>PayPal</li>
                    </ul>
                     <br>
                </div>
               
                <p>PensoPay hjælper dig gennem hele processen, og tilbyder efterfølgende support mellem 8-20, alle ugens dage.</p>
                <p>Du kan ansøge om en gratis prøvegateway, der nemt og hurtigt kan konverteres til en funktionel udgave,
                når du er klar til det. Hør mere her på siden.</p>
            </div>
       <div class="col-sm-12 col-lg-5 col-md-5 mobile_margin_top">
        <div class="login_point" id="login"></div>
                <div class="subscribe-wrapper dark-grey">
                    <?php 
                    $profile_data =  get_row('users','where id = '. $_SESSION['user_id']);
                            $data = mysql_fetch_assoc($profile_data);
                            //user information
                                $first_name     = $data['firstname'];
                                $last_name      = $data['lastname'];
                                $email          = $data['email'];
                                $sql            = get_row('company','where users_id = '. $_SESSION['user_id']);
                                $company_data   = mysql_fetch_assoc($sql);
                                $comapny_cvr    = $company_data['cvr'];
                                $hjemmeside     = $company_data['logo_url'];
                                $telefon        = $company_data['mobile_phone'];
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="sign-up-form">
                    <h3 style="margin-bottom: 0px;">Tilmelding</h3>
                    
                        <div class="row m-t-20">
                           <?php
                                $sql            = get_row('company','where users_id = '. $_SESSION['user_id']);
                                $company_data   = mysql_fetch_assoc($sql);
                                $company_name   = $company_data['name'];
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
                            <div class="col-lg-4">
                                <p>Fulde navn*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_fulde" id="sub_fulde"  value="<?php echo $first_name.' '.$last_name ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="Second_Subscribe"/>
                            <div class="col-lg-4">
                                <p>Email*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_email" id="sub_email" 
                                value="<?php echo $email ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>CVR. Nr.*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_cvr" id="sub_cvr" 
                                value="<?php echo $comapny_cvr ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Hjemmeside*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_hje" id="sub_hje" 
                                value="<?php echo $hjemmeside ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Telefon*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_tel" id="sub_tel" 
                                value="<?php echo $telefon ?>" >
                            </div>
                        </div>
                        
                        <div class="row m-t-20">
                            <p style="margin-top: 0px;">Felter markeret med * skal udfyldes</p><br>
                            <div class="col-lg-8 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary col-lg-12" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','PensoPay');">
                                     Ja tak, jeg vil gerne kontaktes!
                                </button>
                            </div>
                            
                     </div>
                          <div class="row m-t-20 text-center">
                              <p style="width: 95%;margin: 0 auto;">Når du skriver dig op kontakter PensoPay dig snarest, og hjælper dig med evt. spørgsmål eller guider dig gennem oprettelsesprocessen.</p>
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
                    <h1 style="margin-bottom: 0px;">PensoPays løsning samler alt betalingsrelateret på siden i én løsning – ansøg om en gratis løsning her på siden!</h1>  <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN.dk | Betaling på nettet');
        $('head').append('<meta name="description" content="Med den virtuelle salgschef får du kyndig rådgivning af en kompetent og erfaren salgschef, der kan hjælpe dig videre i salgsprocessen. Det månedslige salgsmøde kan være med til at øge salget her og nu og få skabt en holdbar salgsplan for fremtiden.">');
        $('head').append('<meta name="keywords" content="Virtuel salgschef, salg, salgschef, øget salg, forbedret salg, salgsmøde, møde, sælger, gratis">');
    });
</script>