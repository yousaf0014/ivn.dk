<?php include('header.php') ?>
<style type="text/css">
.swiper-container, .swiper-slide {
            width:100%;
            //height:200px;
        }
</style>
<!--Slider-->
<div id="myCarousel" class="carousel carousel-fade slide" data-ride="carousel">

    <!-- Indicators -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div class="container" style="position:relative">
                        <h1 class="slider-heading col-lg-6 col-xs-12 col-sm-12 col-md-6" style="    top: 200px;">Velkommen tilbage 
                            <?php echo '</br>' . $f_name ?></h1>

                        <div class="slider-box col-lg-4 col-xs-4 light-grey desktop right-side-block" style="background-image: none;right: 0px;    padding: 10px 40px;">
                            <h3 class="no-margin">IVN.dk er i luften</h3>
                            <p>De f&oslash;rste spadestik er taget, og nu skal vi sikre, at IVN f&aring;r de bedste vilk&aring;r for at vokse og blive det mest fyldestg&oslash;rende community for iv&aelig;rks&aelig;ttere i Danmark.</p>
                            <img src="assets/images/active-slider-box.png" />
                            <p class="m-t-10">L&aelig;s mere om IVN og hvordan du kan v&aelig;re  med til forme siden efter dine behov.</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="fill mobile" style="background-image:url('assets/images/slider-2.png');    margin-top: 80px;"></div>

                    <img src="assets/images/slider-2.png" class="desktop" />

                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div onclick="location.href = 'lasertryk.php';" class="fill mobile" style="background-image:url('assets/images/ivn-banner-lasertryk.jpg');    margin-top: 80px;"></div>
                    <img onclick="location.href = 'lasertryk.php';" src="assets/images/ivn-banner-lasertryk.jpg" class="desktop" />

                </div>
            </div>


            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div class="container" style="position:relative">
                        <div class="slider-box col-lg-4 col-xs-4 light-grey desktop right-side-block" style="background-image: none;right: 0px;    padding: 10px 40px;">
                            <h3 class="no-margin">S&aelig;rtilbud IVN-medlemmer</h3>
                            <p>Bogen &rdquo;Coach!&rdquo; henvender sig til nystartede terapeuter og coaches, og er en god guide til alle iv&aelig;rks&aelig;ttere, der er i opstartsfasen.</p>
                            <img src="assets/images/slider-active-coach-majken.jpg" />
                            <p class="m-t-10"><a href="bogtilbud.php">F&aring; bogen til s&aelig;rpris.</a></p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div onclick="location.href = 'bogtilbud.php';" class="fill mobile" style="background-image:url('assets/images/ivn-bogen-coach-mobile.jpg');    margin-top: 80px;"></div>

                    <img onclick="location.href = 'bogtilbud.php';" src="assets/images/coach_2.jpg" class="desktop" />

                </div>
            </div>
        <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div class="container" style="position:relative">
                        <div class="slider-box col-lg-4 col-xs-4 light-grey desktop right-side-block" style="background-image: none;right: 0px;    padding: 10px 40px;">
                            <h3 class="no-margin">Virtuel salgschef</h3>
                            <p>Nu kan du skabe bedre salgsresultater med professionel sparring. Prøv det gratis og oplev hvor meget værdi det giver dig.</p>
                            <img src="assets/images/virtual-salgschef-slider.jpg" />
                            <p class="m-t-10">Tilmeld dig <a href="virtuel-salgschef.php">her</a></p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div onclick="location.href = 'virtuel-salgschef.php';" class="fill mobile" style="background-image:url('assets/images/ivn-virtuel-salgschef-mobile.jpg');    margin-top: 80px;"></div>
                    <img onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg" class="desktop"/>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <a href="gratis-advokatraadgivning.php">
                    <div class="fill mobile" style="background-image:url('assets/images/ivn-jura-mobile.png');    margin-top: 80px;"></div>
                    <img src="assets/images/ivn-jura.png" class="desktop" style="    height: 551px;"/>
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div class="container" style="position:relative">
                            <div class="slider-box col-lg-4 col-xs-4 light-grey desktop right-side-block" style="background-image: none;right: 0px;    padding: 10px 40px;">
                                <h3 class="no-margin">Komplet betalingsløsning til din webshop</h3>
                                <p>PensoPays løsning samler både betaling og indløsning i en gateway, der er nem og hurtig at installere på din eksisterende webshop.</p>
                                <img src="assets/images/ivn-online-betaling-slider.jpg" />
                                <p class="m-t-10"><a href="betaling-paa-nettet.php">Læs mere her</a></p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                    </div>

                    <div onclick="location.href = 'betaling-paa-nettet.php';" class="fill mobile" style="background-image:url('assets/images/ivn-online-betaling-mobile.jpg');    margin-top: 80px;"></div>
                    <img onclick="location.href = 'betaling-paa-nettet.php';" src="assets/images/ivn-online-betaling.jpg" class="desktop"/>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <div class="container" style="position:relative">
                        <div class="slider-box col-lg-4 col-xs-4 light-grey desktop right-side-block" style="background-image: none;right: 0px;    padding: 10px 40px;">
                            <h3 class="no-margin">Lån til Iværksættere</h3>
                            <p>Lendino yder lån til Iværksættere ud fra en pulje på knap 4.000 långivere. Dermed er nemt for dig at finde nogen, der kan se idéen i din forretningsmodel.</p>
                            <img src="assets/images/ivn-laan-til-ivaerksaettere-slider.jpg" />
                            <p class="m-t-10"><a href="finansiering-af-ivaerksaettere.php">Læs mere her</a></p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div onclick="location.href = 'finansiering-af-ivaerksaettere.php';" class="fill mobile" style="background-image:url('assets/images/ivn-laan-til-ivaerksaettere-mobile.jpg');    margin-top: 80px;"></div>
                    <img onclick="location.href = 'finansiering-af-ivaerksaettere.php';" src="assets/images/ivn-laan-til-ivaerksaettere.jpg" class="desktop"/>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item active slide-1 animated slideInRight">
                    <a href="faa-en-pris-paa-web-loesninger.php">
                    <div class="fill mobile" style="background-image:url('assets/images/ivn-find-din-pris-mobile.png');margin-top: 80px;"></div>
                    <img src="assets/images/find-din-pris.png" class="desktop"/>
                    </a>
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
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

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
                        <p>Iv&aelig;rks&aelig;tter Netv&aelig;rk opstod p&aring; Facebook som en gruppe, der voksede og voksede. Efter otte &aring;r er 40.000 danske iv&aelig;rks&aelig;ttere blevet medlemmer af gruppen, og vi er derfor den suver&aelig;nt st&oslash;rste samling af iv&aelig;rks&aelig;ttere i Danmark. IVN er det n&aelig;ste naturlige skridt i udviklingen af et community, der har vokset sig for stort til blot en gruppe. Vi vil ikke diktere, hvordan dit IVN skal se ud, for vi ved, at vi har mange af landets bedste hjerner samlet i denne gruppe. Derfor v&aelig;lger vi i stedet at invitere jer med p&aring; rejsen. V&aelig;r med til at forme IVN. Fort&aelig;l os, hvad du mangler, og hvad der kan g&oslash;re siden bedre. Del dine gode id&eacute;er og s&aelig;t ord p&aring; dine behov. IVN er starten, men potentialet er uanet, og vi er f&oslash;rst lige begyndt.</p>
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
        $(window).resize(function(){
        /*  
          $('.swiper-container').css({height: $('.swiper-container').find('img').height()})
          $('.slider-box').css({height: $('.swiper-container').find('img').height()})
          //ReInit Swiper
          swiper.reInit() */
        })


        $(document).ready(function () {
            //$('.slider-box').css({height: $('.swiper-container').find('img').height()})
            $(document).prop('title', 'IVN - Velkommen til Iværksætter Netværk');
            $('head').append('<meta name="description" content="Med IVN.dk har Facebook-gruppen Iv�rks�tter Netv�rks 40.000 medlemmer f�et en platform, de kan forme til deres egne behov. Vi har samlet mange af landets bedste hoveder, og vi vil gerne udnytte jeres id�er til at udvikle IVN.dk.">');
            $('head').append('<meta name="keywords" content="Iv�rks�tter, iv�rks�ttere, iv�rks�tteri, forretninger, start-up, virksomhedsopstart, Iv�rks�tter Netv�rk, netv�rk, networking">');
            $('.container').height($('.item').find('img.desktop').height() - 100})
        });
    </script>