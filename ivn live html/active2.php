<?php include('header.php') ?>
<!--Slider-->
<div id="myCarousel" class="carousel carousel-fade slide" data-ride="carousel">

    <div class="header_slider">
    <!-- Indicators -->        
        <?php
            $flag = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); 
        if(!$flag){ ?>
            <div class="innderPage">
                    <!--  We need to uncomment this when number of pages increase more then 6 and new dive apprear 
                    <div class="col-lg-12 col-sm-1">
                        <a class="carousel-control left" href="#myCarousel1" data-slide="prev">

                        </a>
                    </div>
                    -->
                    <div id="myCarousel1" class="carousel slide vertical">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item">
                                <div onclick="location.href = 'bogtilbud.php';" class="inner_div">
                                    <img src="assets/box_images/bogtilbud.jpg"/>
                                    <span class="innner_div_span">Bogtilbud</span>
                                </div>
                            
                                <div onclick="location.href = 'virtuel-salgschef.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                                    <span class="innner_div_span">Virtuel Salgschef</span>
                                </div>
                                <div onclick="location.href = 'gratis-advokatraadgivning.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-jura-box.jpg" />
                                    <span class="innner_div_span">Gratis Advokatrådgivning</span>
                                </div>
                                <div onclick="location.href = 'iaerksaettere.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                                    <span class="innner_div_span">Finansiering af Iværksætteri</span>
                                </div>
                                <div onclick="location.href = 'payment.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-online-betaling-box.jpg"/>
                                    <span class="innner_div_span">Betaling på nettet</span>
                                </div>
                                
                                <div onclick="location.href = 'faa-en-pris-paa-web-loesninger.php';" class="inner_div">
                                    <img src="assets/box_images/onlinebetling.jpg"/>
                                    <span class="innner_div_span">Få en Pris På Web-løsninger</span>
                                </div>
                                <div class="clearfix"></div>
                            </div> 
                                
                            <!-- Need to user class item to show more pages ->
                            <div class="item"></div> -->

                        </div>
                        <!-- Carousel nav -->                    
                    </div>
                
                    
                    <!-- Need to give image and a bit style sheet to show pagination arrows 
                    <div class="col-lg-12 col-sm-4">
                        <a class="carousel-control right" href="#myCarousel1" data-slide="next">›</a>
                    </div>
                        -->
            </div>

        <?php } ?>
            <div class="swiper-container">

            <!-- Additional required wrapper -->
             <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Velkommen til IVN</h4>
                                <p>IVN er det næste naturlige skridt i udviklingen af et community, der har vokset sig for stort til blot en gruppe. Her på siden finder du gode tilbud og andet, der kan hjælpe dig videre med din forretning.</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="fill mobile" style="background-image:url('assets/images/slider-2.png');    margin-top: 80px;"></div>

                        <img src="assets/images/slider-2.png" class="desktop" style="    height: 551px;"/>

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Bogtilbud</h4>
                                <p>Bogen "COACH! Fra Drøm til Virkelighed" giver dig den nødvendige viden om, hvad du skal tage med i betragtning, når du starter op som selvstændig. Få rabat. </p>
                                <a href="bogtilbud.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'bogtilbud.php';" class="fill mobile" style="background-image:url('assets/images/ivn-bogen-coach-mobile.jpg');    margin-top: 80px;"></div>

                        <img onclick="location.href = 'bogtilbud.php';" src="assets/images/coach_2.jpg" class="desktop" style="    height: 551px;"/>

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Virtuel Salgschef</h4>
                                <p>Få hjælp til dit salg med den virtuelle salgschef. IVNs medlemmer får en måneds gratis prøveperiode. </p>
                                <a href="virtuel-salgschef.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div onclick="location.href = 'virtuel-salgschef.php';" class="fill mobile" style="background-image:url('assets/images/ivn-virtuel-salgschef-mobile.jpg');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg" class="desktop" style="    height: 551px;"/>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Gratis advokatrådgivning</h4>
                                <p>Juraen omkring iværksætteri er svær at finde rundt i. Derfor tilbyder IVN og KVIKAdvokat alle medlemmer en times advokatbistand.</p>
                                <a href="gratis-advokatraadgivning.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>                        
                        <div onclick="location.href = 'gratis-advokatraadgivning.php';" class="fill mobile" style="background-image:url('assets/images/ivn-jura-mobile.png');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'gratis-advokatraadgivning.php';" src="assets/images/ivn-jura.png" class="desktop" style="    height: 551px;"/>
                        
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Betaling på nettet</h4>
                                <p>PensoPays løsning samler betaling og indløsning i en gateway. Den er kompatibel med mange forskellige CMS-systemer og nem at bruge.</p>
                                <a href="finansiering-af-ivaerksaettere.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div onclick="location.href = 'finansiering-af-ivaerksaettere.php" class="fill mobile" style="background-image:url('assets/images/ivn-laan-til-ivaerksaettere-mobile.jpg');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'finansiering-af-ivaerksaettere.php" src="assets/images/ivn-laan-til-ivaerksaettere.jpg" class="desktop" style="    height: 551px;"/>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity" >
                                <h4 style="font-weight:bold;margin-bottom:0;">Finansiering af iværksætteri</h4>
                                <p>Lendino formidler erhvervs- og netværkslån på helt op til 2 mio. kroner til iværksættere med gode vilkår og en hurtig behandlingstid.</p>
                                <a href="betaling-paa-nettet.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div> 

                        <div onclick="location.href = 'betaling-paa-nettet.php" class="fill mobile" style="background-image:url('assets/images/ivn-online-betaling-mobile.jpg');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'betaling-paa-nettet.php" src="assets/images/ivn-online-betaling.jpg" class="desktop" style="    height: 551px;"/>
                    </div>
                </div>                
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Få tilbud på web-løsninger</h4>
                                <p>Vores prisberegner kan både give et estimat på dine online-, SEO- og SoMe-behov, og sende din forespørgsel til vores samarbejdspartnere.</p>
                                <a href="faa-en-pris-paa-web-loesninger.php" style="float:right">Læs mere</a></p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" class="fill mobile" style="background-image:url('assets/images/ivn-find-din-pris-mobile.png');margin-top: 80px;"></div>
                        <img onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" src="assets/images/find-din-pris.png" class="desktop" style="    height: 551px;"/>
                        
                    </div>
                </div>
                




                <!--<div class="swiper-slide">
                 <div class="item active slide-1 animated slideInRight">
            <div class="container" style="position:relative">
      
                            
               
                 <div class="clearfix"></div>
           </div>
            <div onclick="location.href='nytaarskur2017.php';" class="fill mobile" style="background-image:url('assets/images/nytaarskur_2017_cover_2.jpg');"></div>
             
             <img onclick="location.href='nytaarskur2017.php';" src="assets/images/nytaarskur_2017_cover_2.jpg" class="desktop" style="    height: 551px;"/>
             
            </div>
            </div>-->





            </div>
            <!-- If we need pagination --
            <div class="swiper-pagination"></div>-->

            <!-- If we need navigation buttons 
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>-->

        </div>
        <?php if(true){ ?>
        <div id="mobile_div">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heroSlider-fixed">
                         <!-- Slider -->
                        <div class="slider responsive">
                            <div onclick="location.href = 'bogtilbud.php';" class="inner_div">
                                <img src="assets/box_images/bogtilbud.jpg"/>
                                <span class="innner_div_span">Bogtilbud</span>
                            </div>                            
                            <div onclick="location.href = 'virtuel-salgschef.php';" class="inner_div">
                                <img src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                                <span class="innner_div_span">Virtuel Salgschef</span>
                            </div>                            
                            <div onclick="location.href = 'gratis-advokatraadgivning.php';" class="inner_div">
                                <img src="assets/box_images/ivn-jura-box.jpg" />
                                <span class="innner_div_span">Gratis Advokatrådgivning</span>
                            </div>
                            <div onclick="location.href = 'iaerksaettere.php';" class="inner_div">
                                <img src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                                <span class="innner_div_span">Finansiering af Iværksætter</span>
                            </div>
                            
                            <div onclick="location.href = 'payment.php';" class="inner_div">
                                <img src="assets/box_images/ivn-online-betaling-box.jpg"/>
                                <span class="innner_div_span">Betaling på nettet</span>
                            </div>
                            
                            <div onclick="location.href = 'faa-en-pris-paa-web-loesninger.php';" class="inner_div">
                                <img src="assets/box_images/onlinebetling.jpg"/>
                                <span class="innner_div_span">Få en Pris På Web-løsninger</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                        

        <?php } ?>        
    </div>




    <!--Access Section-->
    <section>
        <div class="container">    
            <div class="row">
                <div class="col-lg-12 m-t-10 text-center">
                    <h1>Danmarks st&oslash;rste m&oslash;dested for iv&aelig;rks&aelig;ttere</h1>
                </div>
            </div><!--/row-->
        </div><!--Container-->
    </section><!--/Access Section-->

    <!--Logedin Home Page-->
    <section>
        <div class="container-fluid offwhite m-t-10">
            <div class="container below-padding neg-t-m-20">
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/blog-1.png"/>
                        <h3>Hvad er IVN?</h3>
                        <p>Iv&aelig;rks&aelig;tter Netv&aelig;rk opstod p&aring; Facebook som en gruppe, der voksede og voksede. Efter otte &aring;r er 30.000 danske iv&aelig;rks&aelig;ttere blevet medlemmer af gruppen, og vi er derfor den suver&aelig;nt st&oslash;rste samling af iv&aelig;rks&aelig;ttere i Danmark. IVN er det n&aelig;ste naturlige skridt i udviklingen af et community, der har vokset sig for stort til blot en gruppe. Vi vil ikke diktere, hvordan dit IVN skal se ud, for vi ved, at vi har mange af landets bedste hjerner samlet i denne gruppe. Derfor v&aelig;lger vi i stedet at invitere jer med p&aring; rejsen. V&aelig;r med til at forme IVN. Fort&aelig;l os, hvad du mangler, og hvad der kan g&oslash;re siden bedre. Del dine gode id&eacute;er og s&aelig;t ord p&aring; dine behov. IVN er starten, men potentialet er uanet, og vi er f&oslash;rst lige begyndt.</p>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/blog-2.png"/>
                        <h3>Hvorfor IVN?</h3>
                        <p>Vi ved, om nogen, at der er mange faldgruber p&aring; vejen til et succesfuldt iv&aelig;rks&aelig;tteri. Vi ved ogs&aring;, at selvom vores dr&oslash;mme er vore egne, deler vi &oslash;nsket om at f&oslash;re vores id&eacute;er ud i livet med mange andre. Derfor skal vi g&oslash;re IVN til den platform, der kan im&oslash;dekomme alle de behov, vi har for at blive bedre og sikre vores iv&aelig;rks&aelig;tterier. Vi er vokset med Facebook, og tiden er nu moden til at finde rammer, der kan im&oslash;dekomme vores voksende behov. Gruppen vil stadig best&aring;, for de fleste mennesker bruger dagligt Facebook, men ved at skabe IVN.dk har vi fuldst&aelig;ndig frie h&aelig;nder til at f&oslash;re vores id&eacute;er ud i livet og skabe det mest komplette community for iv&aelig;rks&aelig;ttere.</p>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/blog-3.png"/>
                        <h3>Hvad nu?</h3>
                        <p>Vi har skabt et fundament, som vi skal bygge videre p&aring;. Vi arbejder p&aring; h&oslash;jtryk p&aring; at f&oslash;re nogle af vores id&eacute;er ud i livet og f&aring; dem bygget ind i IVN.dk. Der er sp&aelig;ndende ting i vente, men det skal ikke afholde dig fra at fort&aelig;lle os, hvad du savner. Ved du lige pr&aelig;cis, hvad der kunne g&oslash;re IVN bedre, s&aring; sig til. Vi indbyder nemlig alle vores medlemmer til at v&aelig;re med til at forme IVN. For det er kun ved at tr&aelig;kke p&aring; vores f&aelig;lles erfaringer, at vi kan g&oslash;re IVN til den komplette l&oslash;sning for alle iv&aelig;rks&aelig;ttere. N&aring;r nu vi har adgang til mange af landets mest kreative og id&eacute;rige hjerner, ville det v&aelig;re en skam ikke at lade dem byde ind, hvor de vil. For IVN er dit community, s&aring; hvis du ved, hvad vi mangler, s&aring; lad os vide det og v&aelig;r med til at skabe et site, der tilfredsstiller dine behov for viden, samarbejde, tjenesteudvekslinger eller hvad du mangler. For IVN er, hvad vi g&oslash;r det til, og nu er der ingen, der holder os tilbage.</p>
                    </div>
                </div><!--/row-->
            </div><!--container-->
        </div><!--outer-continer-->
    </section>
    <!--Logedin Home Page-->
    <section>
        <div class="container-fluid ex-dark-grey tp-padding">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h1 style="margin-bottom:0px;">V&aelig;r med til at forme IVN.dk</h1>
                        <p>IVN er din side. G&aring;r du med en god id&eacute; til, hvordan vi kan v&aelig;re med til at sikre, at vi er i front og kan im&oslash;dekomme vores medlemmers behov, s&aring; kontakt os</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php') ?>
    <!--- Append Meta Tags and Description using jquery-->
    <script type="text/javascript">
        $('.responsive').slick({
          dots: true,
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
          infinite: false,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 4,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 320,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            }

            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });

        $(document).ready(function () {
            $('.carousel').carousel({
              interval: 0
            })
            var winWidth = window.innerWidth/3;
            $('.innner_div_span').width(winWidth);
            $(document).prop('title', 'IVN - Velkommen til Iværksætter Netværk');
            $('head').append('<meta name="description" content="Med IVN.dk har Facebook-gruppen Iv�rks�tter Netv�rks 30.000 medlemmer f�et en platform, de kan forme til deres egne behov. Vi har samlet mange af landets bedste hoveder, og vi vil gerne udnytte jeres id�er til at udvikle IVN.dk.">');
            $('head').append('<meta name="keywords" content="Iv�rks�tter, iv�rks�ttere, iv�rks�tteri, forretninger, start-up, virksomhedsopstart, Iv�rks�tter Netv�rk, netv�rk, networking">');
        });
    </script>