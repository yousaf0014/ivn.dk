<?php include('header.php') ?>
<script>
        jQuery(document).ready(function ($) {
            var _SlideshowTransitions = [
            //Zoom- in
            {$Duration: 1200, $Zoom: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad }, $Opacity: 2 },
            //Zoom+ out
            {$Duration: 1000, $Zoom: 11, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
            //Rotate Zoom- in
            {$Duration: 1200, $Zoom: 1, $Rotate: 1, $During: { $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out
            {$Duration: 1000, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

            //Zoom HDouble- in
            {$Duration: 1200, x: 0.5, $Cols: 2, $Zoom: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
            //Zoom HDouble+ out
            {$Duration: 1200, x: 4, $Cols: 2, $Zoom: 11, $SlideOut: true, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },

            //Rotate Zoom- in L
            {$Duration: 1200, x: 0.6, $Zoom: 1, $Rotate: 1, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out R
            {$Duration: 1000, x: -4, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },
            //Rotate Zoom- in R
            {$Duration: 1200, x: -0.6, $Zoom: 1, $Rotate: 1, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out L
            {$Duration: 1000, x: 4, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

            //Rotate HDouble- in
            {$Duration: 1200, x: 0.5, y: 0.3, $Cols: 2, $Zoom: 1, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate HDouble- out
            {$Duration: 1000, x: 0.5, y: 0.3, $Cols: 2, $Zoom: 1, $Rotate: 1, $SlideOut: true, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Top: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate VFork in
            {$Duration: 1200, x: -4, y: 2, $Rows: 2, $Zoom: 11, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Row: 28 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate HFork in
            {$Duration: 1200, x: 1, y: 2, $Cols: 2, $Zoom: 11, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Column: 19 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
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
                    $DisplayPieces: 4,                             //[Optional] Number of pieces to display, default value is 1
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
                    </div>  
                    <div>       
                        <img u="image" onclick="location.href = 'bogtilbud.php';" src="assets/images/coach_2.jpg"/>
                        <img u="thumb" src="assets/box_images/bogtilbud.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg"/>
                        <img u="thumb" src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'gratis-advokatraadgivning.php';" src="assets/images/ivn-jura.png" />
                        <img u="thumb" src="assets/box_images/ivn-jura-box.jpg" />
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'finansiering-af-ivaerksaettere.php" src="assets/images/ivn-laan-til-ivaerksaettere.jpg"/>
                        <img u="thumb" src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'betaling-paa-nettet.php" src="assets/images/ivn-online-betaling.jpg" />
                        <img u="thumb" src="assets/box_images/ivn-online-betaling-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" src="assets/images/find-din-pris.png" />
                        <img u="thumb" src="assets/box_images/onlinebetling.jpg"/>
                    </div>
                    <div>       
                        <img u="image" onclick="location.href = 'bogtilbud.php';" src="assets/images/coach_2.jpg"/>
                        <img u="thumb" src="assets/box_images/bogtilbud.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'virtuel-salgschef.php';" src="assets/images/ivn-virtuel-salgschef.jpg"/>
                        <img u="thumb" src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'gratis-advokatraadgivning.php';" src="assets/images/ivn-jura.png" />
                        <img u="thumb" src="assets/box_images/ivn-jura-box.jpg" />
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'finansiering-af-ivaerksaettere.php" src="assets/images/ivn-laan-til-ivaerksaettere.jpg"/>
                        <img u="thumb" src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'betaling-paa-nettet.php" src="assets/images/ivn-online-betaling.jpg" />
                        <img u="thumb" src="assets/box_images/ivn-online-betaling-box.jpg"/>
                    </div>
                    <div>
                        <img u="image" onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" src="assets/images/find-din-pris.png" />
                        <img u="thumb" src="assets/box_images/onlinebetling.jpg"/>
                    </div>

                              
                </div>
                
                <!-- Arrow Navigator Skin Begin -->
                <style>
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
            <div u="thumbnavigator" class="jssort02" style="position: absolute; width:532px; height: 675px; right:150px; top:0px; ">
        
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
                .jssort02 .c
                {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    border: #000 2px solid;
                }
                .jssort02 .p:hover .c, .jssort02 .pav:hover .c, .jssort02 .pav .c 
                {
                    background: url(../img/t01.png) center center;
                    border-width: 0px;
                    top: 2px;
                    left: 2px;
                    width: 100%;
                    height: 100%;
                }
                .jssort02 .p:hover .c, .jssort02 .pav:hover .c
                {
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    border: #fff 1px solid;
                }
            </style>
                    <div u="slides" style="cursor: move;">
                        <div u="prototype" class="p" style="position: absolute; width: 266px; height: 170px; top: 0; left: 0;">
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
                                <h4 style="font-weight:bold;margin-bottom:0;">Bogtilbud</h4>
                                <p>Bogen "COACH! Fra Drøm til Virkelighed" giver dig den nødvendige viden om, hvad du skal tage med i betragtning, når du starter op som selvstændig. Få rabat. </p>
                                <a href="bogtilbud.php" style="float:right">Læs mere</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'bogtilbud.php';" class="fill mobile" style="background-image:url('assets/images/ivn-bogen-coach-mobile.jpg');    margin-top: 80px;"></div>

                        <img onclick="location.href = 'bogtilbud.php';" src="assets/images/coach_2.jpg" class="desktop"/>

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
                                <h4 style="font-weight:bold;margin-bottom:0;">Betaling på nettet</h4>
                                <p>PensoPays løsning samler betaling og indløsning i en gateway. Den er kompatibel med mange forskellige CMS-systemer og nem at bruge.</p>
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
                                <h4 style="font-weight:bold;margin-bottom:0;">Finansiering af iværksætteri</h4>
                                <p>Lendino formidler erhvervs- og netværkslån på helt op til 2 mio. kroner til iværksættere med gode vilkår og en hurtig behandlingstid.</p>
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
                                <a href="faa-en-pris-paa-web-loesninger.php" style="float:right">Læs mere</a></p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" class="fill mobile" style="background-image:url('assets/images/ivn-find-din-pris-mobile.png');margin-top: 80px;"></div>
                        <img onclick="location.href = 'faa-en-pris-paa-web-loesninger.php" src="assets/images/find-din-pris.png" class="desktop" />
                        
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
                                <div onclick="location.href = 'bogtilbud.php';" class="inner_div">
                                    <img src="assets/box_images/bogtilbud.jpg"/>
                                    <span class="innner_div_span">Bogtilbud</span>
                                </div>
                                <div onclick="location.href = 'virtuel-salgschef.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-virtuel-salgschef-box.jpg"/>
                                    <span class="innner_div_span">Virtuel Salgschef</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'gratis-advokatraadgivning.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-jura-box.jpg" />
                                    <span class="innner_div_span">Gratis Advokatrådgivning</span>
                                </div>
                                <div onclick="location.href = 'finansiering-af-ivaerksaettere.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-laan-til-ivaerksaettere-box.jpg"/>
                                    <span class="innner_div_span">Finansiering af Iværksætter</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item active slide-1 animated slideInRight">
                                <div onclick="location.href = 'betaling-paa-nettet.php';" class="inner_div">
                                    <img src="assets/box_images/ivn-online-betaling-box.jpg"/>
                                    <span class="innner_div_span">Betaling på nettet</span>
                                </div>
                                
                                <div onclick="location.href = 'faa-en-pris-paa-web-loesninger.php';" class="inner_div">
                                    <img src="assets/box_images/onlinebetling.jpg"/>
                                    <span class="innner_div_span">Få en pris på Web-løsninger</span>
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
    <section>
        <div class="container-fluid offwhite m-t-10">
            <div class="container below-padding neg-t-m-20">
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-bogtilbud.jpg"/>
                        <h3>Få bogen "Coach" med medlemsrabat </h3>
                        <p>Bogen “Coach” er essentiel for enhver, der vil starte op som coach, behandler, rådgiver eller terapeut. Den er fyldt med viden, der også kan bruges af andre iværksættere, der vil sikre sig den bedst mulige opstart som selvstændig.  </p>
                        <a href="bogtilbud.php" style="float:right">Læs mere</a>
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
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-laan-til-ivaerksaettere.jpg"/>
                        <h3>Lån op til 2 mio. kr. til rimelige vilkår</h3>
                        <p>Lendinos låneordninger er målrettede iværksættere. Uanset om du søger et Erhvervs- eller netværkslån, taler du til en af Lendinos 3.914 långivere, der elsker iværksættere. Søg fra computeren. Nemt og hurtigt.</p>
                        <a href="iaerksaettere.php" style="float:right">Læs mere</a>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-online-betaling.jpg"/>
                        <h3>Indløsning og onlinebetaling i én samlet løsning</h3>
                        <p>Mangler du en betalingsgateway til din webshop? PensoPays løsning har samlet både betaling og indløsning i en gateway, som passer til de fleste webløsninger i dag. Alt er Plug-and-play og kan kobles op uden problemer. </p>
                        <a href="betaling-paa-nettet.php" style="float:right">Læs mere</a>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 m-t-20">
                        <img src="assets/images/active_col_images/ivn-prisberegner.jpg"/>
                        <h3>Få en pris på netop din online opgave</h3>
                        <p>Vores prisberegner giver nemt og hurtigt et estimat på det arbejde, du skal have lavet online – fra webshop eller en opstramning af dit Seo. Når du har fyldt alting ud, er det nemt at sende forespørgslen videre til én af vores mange samarbejdspartnere.</p>
                        <a href="faa-en-pris-paa-web-loesninger.php" style="float:right">Læs mere</a>
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