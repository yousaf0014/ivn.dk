<?php include('header.php') ?>
<script>
        jQuery(document).ready(function ($) {
            var _SlideshowTransitions = [
            //Zoom- in
            
            //Rotate Zoom- in R
            {$Duration: 1200, x: -1, $Zoom: 1, $Rotate: 0, $During: { $Left: [0.2, 0.8], $Zoom: [1, 1], $Rotate: [0.2, 0.8] }, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 1, $Round: { $Rotate: 0.5} },
            
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 7000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 600,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                    $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $Lanes: 2,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 0,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 0,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 3,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 2                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                }
            };


            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 1920), 300));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
<!--Slider-->
<div id="myCarousel" class="carousel carousel-fade slide" data-ride="carousel">

    <div class="header_slider" style="widht:100%; overflox-x:hidden">
    <!--Indicators-->        
    
        <?php  if(!$mobile){ ?>
        <div class-"col-lg-12" style="padding-top:80px">

        <!-- Jssor Slider Begin -->
            <!-- You can move inline styles to css file or css block. -->
            <div id="slider1_container" style="margin:auto;position: relative; top: 0; left: 0px; width:1920px; height: 675px; background: #191919; overflow: hidden;">

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; top: 0px; width:1920px; height: 675px; overflow: hidden;">
                    <div>
                        <img u="image" src="assets/images/slider-2.png" />
                        <div class="backopecity">
                            <h2 style="font-weight:bold;margin-bottom:0;">Velkommen til IVN</h2>
                            <p>IVN er det næste naturlige skridt i udviklingen af et community, der har vokset sig for stort til blot en gruppe. Her på siden finder du gode tilbud og andet, der kan hjælpe dig videre med din forretning.</p>
                        </div>
                        <div u="thumb">
                            <img src="assets/box_images/home.png"/>                            
                        </div>                        
                    </div>  
                    
                    <div>       
                        <img u="image" onclick="location.href = 'lasertryk.php';" src="assets/images/ivn-banner-lasertryk.jpg"/>
                        <div class="backopecity">
                            <h2 style="font-weight:bold;margin-bottom:0;">Få billige tryksager med IVN og LaserTryk</h2>
                            <p>Alle IVNs medlemmer får rabat på tryksager, når de køber gennem vores butik hos LaserTryk. Vi sikrer lave iværksættervenlige priser.</p>
                            <a href="lasertryk.php" style="float:right">Læs mere</a>                            
                        </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-banner-lasertryk.jpg"/>
                            <span class="innner_div_span">Billige tryksager</span>
                        </div>
                        
                    </div>


                    <div>       
                        <img u="image" onclick="location.href = 'bogtilbud.php';" src="assets/images/ivn-bogtilbud-box.jpg"/>
                        <div class="backopecity">
                            <h2 style="font-weight:bold;margin-bottom:0;">Bogtilbud</h2>
                            <p>Bogen "COACH! Fra Drøm til Virkelighed" giver dig den nødvendige viden om, hvad du skal tage med i betragtning, når du starter op som selvstændig. Få rabat. </p>
                            <a href="bogtilbud.php" style="float:right">Læs mere</a>                            
                        </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-bogtilbud-box.jpg"/>
                            <span class="innner_div_span">Bogtilbud</span>
                        </div>
                        
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg"/>
                        <div class="backopecity">
                                <h2 style="font-weight:bold;margin-bottom:0;">Virtuel Salgschef</h2>
                                <p>Få hjælp til dit salg med den virtuelle salgschef. IVNs medlemmer får en måneds gratis prøveperiode. </p>
                                <a href="virtuel-salgschef.php" style="float:right">Læs mere</a>
                                
                            </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                            <span class="innner_div_span">Virtuel Salgschef</span>
                        </div>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'gratis-advokatraadgivning.php';" src="assets/images/ivn-jura.png" />
                        <div class="backopecity">
                                <h2 style="font-weight:bold;margin-bottom:0;">Gratis advokatrådgivning</h2>
                                <p>Juraen omkring iværksætteri er svær at finde rundt i. Derfor tilbyder IVN og KVIKAdvokat alle medlemmer en times advokatbistand.</p>
                                <a href="gratis-advokatraadgivning.php" style="float:right">Læs mere</a>
                                
                            </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-jura-box.jpg" />
                            <span class="innner_div_span">Gratis Advokatrådgivning</span>
                        </div>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'finansiering-af-ivaerksaettere.php';" src="assets/images/ivn-laan-til-ivaerksaettere.jpg"/>
                        <div class="backopecity">
                                <h2 style="font-weight:bold;margin-bottom:0;">Finansiering af iværksætteri</h2>
                                <p>Lendino formidler erhvervs- og netværkslån på helt op til 2 mio. kroner til iværksættere med gode vilkår og en hurtig behandlingstid.</p>
                                <a href="finansiering-af-ivaerksaettere.php" style="float:right">Læs mere</a>                                
                            </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                            <span class="innner_div_span">Finansiering af Iværksætter</span>
                        </div>

                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'betaling-paa-nettet.php';" src="assets/images/ivn-online-betaling.jpg" />
                        <div class="backopecity" >
                                <h2 style="font-weight:bold;margin-bottom:0;">Betaling på nettet</h2>
                                <p>PensoPays løsning samler betaling og indløsning i en gateway. Den er kompatibel med mange forskellige CMS-systemer og nem at bruge.</p>
                                <a href="betaling-paa-nettet.php" style="float:right">Læs mere</a>
                            </div>
                        <div u="thumb">
                            <img src="assets/box_images/ivn-online-betaling-box.jpg"/>
                            <span class="innner_div_span">Betaling på nettet</span>
                        </div>
                        
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'website-eller-webshop.php';" src="assets/images/ivn-thagaard-banner.png" />
                         <!-- <div class="backopecity">
                            <h2 style="font-weight:bold;margin-bottom:0;">Webshop eller hjemmeside</h2>
                            <p>Uanset om du skal have en skræddersyet webshop eller fremtidssikret hjemmeside kan vi klare det.</p>
                            <a href="website-eller-webshop.php" style="float:right">Læs mere</a></p>                            
                        </div> -->
                        <div u="thumb">
                            <img src="assets/box_images/ivn-thagaard-box.png"/>
                            <span class="innner_div_span">Webshop eller hjemmeside</span>
                        </div>
                        
                    </div>                    
                                                                    
                </div>
                
                <!-- Arrow Navigator Skin Begin -->
                <style>
                    .home{
                        border: 0px !imporant;
                    }
                    .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
                    {
                        position: absolute;
                        cursor: pointer;
                        display: block;
                        background: url(../img/a17.png) no-repeat;
                        overflow:hidden;
                    }
                    .jssora05l { background-position: -10px -40px; }
                    .jssora05r { background-position: -70px -40px; }
                    .jssora05l:hover { background-position: -130px -40px; }
                    .jssora05r:hover { background-position: -190px -40px; }
                    .jssora05ldn { background-position: -250px -40px; }
                    .jssora05rdn { background-position: -310px -40px; }
                </style>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 248px;">
                </span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
                </span>
                <!-- Arrow Navigator Skin End -->
                
                <!-- Thumbnail Navigator Skin 02 Begin -->
            <div u="thumbnavigator" class="jssort02" style="position: absolute; width:700px; height: 675px; right:150px; top:0px; ">
        
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 02 css */
                /*
                .jssort02 .p            (normal)
                .jssort02 .p:hover      (normal mouseover)
                .jssort02 .pav          (active)
                .jssort02 .pav:hover    (active mouseover)
                .jssort02 .pdn          (mousedown)
                */
                .jssort02 .w
                {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }
                .jssort02 .c,.jssort02 .pav .c
                {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    border: #000 2px solid;
                }
                
            </style>
                    <div u="slides" style="cursor: move;">
                        <div u="prototype" class="p" style="position: absolute; width: 350px; height: 225px; top: 0; left: 0;">
                            <div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                            <div class=c>
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
            </div>
            <!-- Jssor Slider End -->
        </div>



        <?php } ?>
            
        <?php if($mobile){ ?>
            <div class="swiper-container swiper">

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

                        <img src="assets/images/slider-2.png" class="desktop" />

                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Få billige tryksager med IVN og LaserTryk</h4>
                                <p>Alle IVNs medlemmer får rabat på tryksager, når de køber gennem vores butik hos LaserTryk. Vi sikrer lave iværksættervenlige priser.</p>
                                <a href="lasertryk.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'lasertryk.php';" class="fill mobile" style="background-image:url('assets/images/ivn-banner-lasertryk.jpg');    margin-top: 80px;"></div>

                        <img onclick="location.href = 'lasertryk.php';" src="assets/images/ivn-banner-lasertryk.jpg" class="desktop"/>

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
                        
                        <div onclick="location.href = 'bogtilbud.php';" class="fill mobile" style="background-image:url('assets/images/ivn-bogtilbud-box.jpg');    margin-top: 80px;"></div>

                        <img onclick="location.href = 'bogtilbud.php';" src="assets/images/ivn-bogtilbud-box.jpg" class="desktop"/>

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
                        <img onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg" class="desktop" />
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
                        <img onclick="location.href = 'gratis-advokatraadgivning.php';" src="assets/images/ivn-jura.png" class="desktop" />
                        
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Finansiering af iværksætteri</h4>
                                <p>Lendino formidler erhvervs- og netværkslån på helt op til 2 mio. kroner til iværksættere med gode vilkår og en hurtig behandlingstid.</p>
                                
                                <a href="finansiering-af-ivaerksaettere.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div onclick="location.href = 'finansiering-af-ivaerksaettere.php" class="fill mobile" style="background-image:url('assets/images/ivn-laan-til-ivaerksaettere-mobile.jpg');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'finansiering-af-ivaerksaettere.php" src="assets/images/ivn-laan-til-ivaerksaettere.jpg" class="desktop"/>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity" >
                                <h4 style="font-weight:bold;margin-bottom:0;">Betaling på nettet</h4>
                                <p>PensoPays løsning samler betaling og indløsning i en gateway. Den er kompatibel med mange forskellige CMS-systemer og nem at bruge.</p>
                                <a href="betaling-paa-nettet.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div> 

                        <div onclick="location.href = 'betaling-paa-nettet.php" class="fill mobile" style="background-image:url('assets/images/ivn-online-betaling-mobile.jpg');    margin-top: 80px;"></div>
                        <img onclick="location.href = 'betaling-paa-nettet.php" src="assets/images/ivn-online-betaling.jpg" class="desktop" />
                    </div>
                </div>                
                <div class="swiper-slide">
                    <div class="item active slide-1 animated slideInRight">
                        <div class="container" style="position:relative">
                            <div class=" col-lg-4 col-xs-4 backopecity">
                                <h4 style="font-weight:bold;margin-bottom:0;">Få tilbud på web-løsninger</h4>
                                <p>Vores prisberegner kan både give et estimat på dine online-, SEO- og SoMe-behov, og sende din forespørgsel til vores samarbejdspartnere.</p>
                                <a href="website-eller-webshop.php" style="float:right">Læs mere</a></p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'website-eller-webshop.php" class="fill mobile" style="background-image:url('assets/images/ivn-find-din-pris-mobile.png');margin-top: 80px;"></div>
                        <img onclick="location.href = 'website-eller-webshop.php" src="assets/images/ivn-thagaard-banner.png" class="desktop" />
                        
                    </div>
                </div>
            </div>
        </div>

        <div id="mobile_div">
            <div class="swiper-container swiper1">
                    <!-- Additional required wrapper -->
                     <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'lasertryk.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-banner-lasertryk.jpg"/>
                                    <span class="innner_div_span">Billige tryksager</span>
                                </div>
                                <div onclick="location.href = 'bogtilbud.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-bogtilbud-box.jpg"/>
                                    <span class="innner_div_span">Bogtilbud</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'virtuel-salgschef.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                                    <span class="innner_div_span">Virtuel Salgschef</span>
                                </div>
                                <div onclick="location.href = 'gratis-advokatraadgivning.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-jura-box.jpg" />
                                    <span class="innner_div_span">Gratis Advokatrådgivning</span>
                                </div>                                
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'finansiering-af-ivaerksaettere.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                                    <span class="innner_div_span">Finansiering af Iværksætter</span>
                                </div>
                                <div onclick="location.href = 'betaling-paa-nettet.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-online-betaling-box.jpg"/>
                                    <span class="innner_div_span">Betaling på nettet</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'website-eller-webshop.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-thagaard-box.png"/>
                                    <span class="innner_div_span">Webshop eller hjemmeside</span>
                                </div>
                            </div>
                        </div>


                        <div class="swiper-scrollbar"></div>
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
    <section style="">
        <div class="container-fluid offwhite m-t-10">
            <div class="container below-padding neg-t-m-20">
                <div class="row" style="padding:15px 0px;">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/web.jpg"/>
                        <h3>Tryksager til iværksættervenlige priser</h3>
                        <p>Det er vigtigt at komme godt fra start. Derfor samarbejder IVN med Lasertryk om at give dig nogle af markedets laveste priser på tryksager. Uanset hvilke tryksager du har behov for, finder du dem i vores shop</p>
                        <a href="lasertryk.php" style="float:right">Læs mere</a>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-online-betaling.jpg"/>
                        <h3>Indløsning og onlinebetaling i én samlet løsning</h3>
                        <p>Mangler du en betalingsgateway til din webshop? PensoPays løsning har samlet både betaling og indløsning i en gateway, som passer til de fleste webløsninger i dag. Alt er Plug-and-play og kan kobles op uden problemer. </p>
                        <a href="betaling-paa-nettet.php" style="float:right">Læs mere</a>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-prisberegner.png"/>
                        <h3> Skræddersyet webshop eller fremtidssikret hjemmeside</h3>
                        <p>Uanset om du arbejder med websalg eller mangler et digitalt visitkort, kan du komme hurtigt og billigt i gang med Thagaard Konsulenthus. Favorable priser og en grundig dialog sikrer de bedst mulige startbetingelser for din virksomhed. </p>
                        <a href="website-eller-webshop.php" style="float:right">Læs mere</a>
                    </div>
                </div><!--/row-->

                <div class="row" style="padding:20px 0px;">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-laan-til-ivaerksaettere.jpg"/>
                        <h3>Lån op til 2 mio. kr. til rimelige vilkår</h3>
                        <p>Lendinos låneordninger er målrettede iværksættere. Uanset om du søger et Erhvervs- eller netværkslån, taler du til en af Lendinos 3.914 långivere, der elsker iværksættere. Søg fra computeren. Nemt og hurtigt.</p>
                        <a href="finansiering-af-ivaerksaettere.php" style="float:right">Læs mere</a>                        
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-virtuel-salgschef.jpg"/>
                        <h3>Få hjælp til dit salg med en Virtuel Salgschef</h3>
                        <p>Mangler du hjælp til at booste dit salg? Med en virtuel salgschef, får du månedlige salgsmøder, der sætter fokus på din virksomhed. Det kan være med til at løse din umiddelbare udfordringer, samt lægge en længeresigtet plan. </p>
                        <a href="virtuel-salgschef.php" style="float:right">Læs mere</a>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-jura.jpg"/>
                        <h3>Få en times gratis advokatrådgivning</h3>
                        <p>Har du styr på de juridiske aspekter af din virksomhed? IVN og KVIKAdvokat tilbyder en times gratis advokatrådgivning, der sætter fokus på netop dine udfordringer. Alt sammen leveret af advokater, der har årtiers erfaringer og en højt fagligt niveau.</p>
                        <a href="gratis-advokatraadgivning.php" style="float:right">Læs mere</a>
                    </div>
                </div><!--/row-->
                <div class="row" style="padding:20px 0px;">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-bogtilbud.jpg"/>
                        <h3>Få bogen "Coach" med medlemsrabat </h3>
                        <p>Bogen “Coach” er essentiel for enhver, der vil starte op som coach, behandler, rådgiver eller terapeut. Den er fyldt med viden, der også kan bruges af andre iværksættere, der vil sikre sig den bedst mulige opstart som selvstændig.  </p>
                        <a href="bogtilbud.php" style="float:right">Læs mere</a>
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
    
    <!--- Append Meta Tags and Description using jquery-->
    <script type="text/javascript">
        <?php if($mobile){ ?>
              var wid = window.innerWidth;
              var hlf = Math.floor(wid/2);
              $('#mobile_div').width(wid);
              $('.inner_div').width(hlf);
              $('.inner_div img').width(hlf);
              $('.innner_div_span').width(hlf);
              $('.swiper-slide').width(wid);
          <?php }?>
        $(document).ready(function () {
            $('.carousel').carousel({
              interval: 0
            })
            $(document).prop('title', 'IVN - Velkommen til Iværksætter Netværk');
            $('head').append('<meta name="description" content="Med IVN.dk har Facebook-gruppen Iv�rks�tter Netv�rks 40.000 medlemmer f�et en platform, de kan forme til deres egne behov. Vi har samlet mange af landets bedste hoveder, og vi vil gerne udnytte jeres id�er til at udvikle IVN.dk.">');
            $('head').append('<meta name="keywords" content="Iv�rks�tter, iv�rks�ttere, iv�rks�tteri, forretninger, start-up, virksomhedsopstart, Iv�rks�tter Netv�rk, netv�rk, networking">');
        });
    </script>
    <?php include('footer.php') ?>