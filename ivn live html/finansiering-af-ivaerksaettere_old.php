<?php include('header.php') ?>
<!--Slider-->
<section style="padding-top:80px;">

        <div class="fill mobile" style="background-image:url('assets/images/ivn-laan-til-ivaerksaettere.jpg');"></div>
        <div class="desktop"><img src="assets/images/ivn-laan-til-ivaerksaettere.jpg" style="max-height:551px;"/></div>
</section>

<!--Access Section-->
<section>
    <div class="container">    
      <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Lån op til 2 mio. kr. på rimelige vilkår</h1>
            </div>
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->    

<!--Logedin Home Page-->
<section class="offwhite">
<div class="container">
        <div class="row tp-padding">
            <div class="col-lg-7 col-md-7 col-sm-12">
                    <P>Lendino tilbyder iværksættere over hele landet lån på op til 2 mio. kr. over 5 år. Uanset om du mangler lån til at skabe vækst, eksportfremstød eller arbejdskapital tilbyder Lendino en hurtig behandlingsproces og gode vilkår.</p>
                    
                    <P>Som medlem af IVN får du eksklusivt en hurtigere behandlingstid på din ansøgning.</p>
                        
                    <p>Vi tilbyder to forskellige typer lån:</p>
                    <br>
                    <p style="font-size: 18px;"><b>Erhvervslån:</b></p>
                    <p>Lånet kommer ikke fra Lendino selv, men via en af de 3.914 långivere. Lendino er således din partner i låneprocessen, både fra at pudse låneansøgningen af, til at få betalt pengene tilbage til de rette steder. Din
                     
                    kontakt er kun med Lendino. Til gengæld er der større chancer for at finde en långiver, der kan se idéen i netop din forretningsmodel.</p>
                    <p>Det brede udvalg af långivere sikrer en markant lavere rente på dit lån end, hvad du kan finde i banken. Alting foregår online, og du kan søge om lån, så længe du har en etableret kreditværdig virksmohed, der er registreret i Danmark. Ansøgningsprocessen er gratis, og du betaler kun, hvis du bliver godkendt til lånet. Dermed har du intet at tabe</p>
                   <p><b> Du får:</b></p>
                        <ul> 
                            <li>5-15% i rente p.a.</li> <br>
                            <li>Ansøgningsproces på kun 15-20 minutter</li><br>
                            <li>Vi svarer indenfor 4 arbejdsdage</li><br>
                            <li>Ansøg når du har tid fra din computer, ingen spildtid med møder</li><br>
                            <li>Vi låner også ud til iværksættere og små virksomheder</li>
                        </ul>
                    <br>
                   <p style="font-size: 18px;"><b> Netværkslån:</b></p>
                    <p>Skaf dine egne långivere og lad Lendino stå for administrationen. Lendinos nye Netværkslån lader familie, venner, kunder eller andre i dit netværk skaffe den kapital, du skal låne. Lendino sørger for administrationen, og dermed får du et lån, der er med til at engagere og involvere dine interessenter. Du bestemmer selv, hvem du vil invitere til at deltage i lånet.
                    </p>
                    <p><b>Du får:</b></p>
                        <ul>
                            <li>Lån fra dit netværk uden alt det adminstrative bøvl</li><br>
                            <li>Valgfrie vilkår - du sætter selv renten</li><br>
                            <li>Vi håndterer alt det administrative med opkrævninger osv.</li><br>
                            <li>Få øget tilknytning til din virksomhed/forening fra kunder, medlemmer, etc.</li>
                        </ul>
                        <p><b>Vilkår:</b></p>
                        <ul>
                            <li>Omkostning på 1% af lånesummen og et rentetillæg på 1%-point.</li><br>
                            <li>Ingen krav om kaution eller sikkerhed</li>
                        </ul>

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
                                $phone          = $data['mobile_phone'];
                    ?>
                    <form action="#" method="post" id="PensoPay" enctype="multipart/form-data">
                    <div class="sign-up-form">
                    <h3 style="margin-bottom: 0px;">Skal vi kontakte dig?</h3>
                   
                                <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Navn*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_name" id="sub_name"  value="<?php echo $first_name.' '.$last_name ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Telefon*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="sub_phone" id="sub_name"  value="<?php echo $phone ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="SUBSCRIBE_ENT"/>
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
                        
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-12">
                                <p>Jeg vil gøre høre mere om*:</p>
                            </div>
                            <div class="radio radio-primary col-lg-10 col-lg-offset-1">
                                <div class="col-lg-6">
                                    <p> <input type="radio" checked="true" name="more_about" id="erhver" value="Erhvervslån">
                                        <label for="erhver">&nbsp;&nbsp;Erhvervslån</label>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p> <input type="radio" name="more_about" id="nervae" value="Netværkslån">
                                        <label for="nervae">&nbsp;&nbsp;Netværkslån</label>
                                    </p>
                                </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <p style="margin-top: 0px;">Felter markeret med * skal udfyldes</p><br>
                            <div class="col-lg-8 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary col-lg-12" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Lendino')">
                                    ”Ja tak, jeg vil gerne kontaktes
                                </button>
                            </div>
                            
                     </div>
                          <div class="row m-t-20 text-center">
                              <p style="width: 95%;margin: 0 auto;">Når du skriver dig op, vil du blive kontaktet af en medarbejder fra Lendino.</p>
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
                    <h1 style="margin-bottom: 0px;">Lendino tilbyder lån gennem 3.914 långivere, der alle har gode erfaringer med at hjælpe iværksættere.</h1>  <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN.dk | Finansiering af Iværksættere');
        $('head').append('<meta name="description" content="Med den virtuelle salgschef får du kyndig rådgivning af en kompetent og erfaren salgschef, der kan hjælpe dig videre i salgsprocessen. Det månedslige salgsmøde kan være med til at øge salget her og nu og få skabt en holdbar salgsplan for fremtiden.">');
        $('head').append('<meta name="keywords" content="Virtuel salgschef, salg, salgschef, øget salg, forbedret salg, salgsmøde, møde, sælger, gratis">');
    });
</script>