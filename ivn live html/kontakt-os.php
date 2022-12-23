<?php include('header.php') ?>
<style>
.access-wrapper {
    min-height: 476px;
}
</style>
<!--Slider-->
<div class="swiper-container" style="padding-top:80px;">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div calss="swiper-slide">
             <div class="item active slide-2 animated slideInRight">
				<div class="fill mobile" style="background-image:url('assets/images/slider-2.png');"></div>
         		<img src="assets/images/slider-2.png" class="desktop" style="    height: 551px;"/>
         		<h1 class="slider-heading col-lg-12 col-xs-12 col-sm-12 col-md-12">
         			Velkommen til IVN.dk</br>Danmarks st&oslash;rste iv&aelig;rks&aelig;tternetv&aelig;rk</h1>
        	</div>
        </div>
        <?php /*<div class="swiper-slide"> 
                    <div class="item  slide-1 animated slideInRight">
            <div class="container" style="position:relative;">
                <div class="slider-box desktop">
                    <h1 class="no-margin">Vi samler landets iv&aelig;rks&aelig;ttere</h1>
                    <p class="m-t-10">IVN.dk nu. Vi er landets st&oslash;rste community af iv&aelig;rks&aelig;ttere &ndash; og vi vokser dagligt.</p>
                    <img src="assets/images/slider-overlay-box.png" class="slider-box-img" />
                 <div class="clearfix"></div>
                </div>
               
            </div>
            <div class="fill mobile" style="background-image:url('assets/images/slider-1.png');"></div>
             <img src="assets/images/slider-1.png" class="desktop" style="    height: 551px;"/>
            </div>

        </div> */?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
    
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    
    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>

<!--Access Section-->
<section>

    <div class="container">    
      <div class="row">
        <!--Signup-->
        <div class="login_point" id="login"></div>
        <div class="col-sm-12 col-lg-4  m-t-30">
                <div class="access-wrapper contact-info dark-grey">
                 <h1>Om IVN.dk</h1>
                 <p>Iv&aelig;rks&aelig;tter Netv&aelig;rk IVS</p>
                 <p>Dr&aring;by Bygade 43</p>
                 <p>DK-8400 Ebeltoft</p>
                 <br>
                 <p><a href="mailto:info@ivn.dk">info@ivn.dk</a></p>
                 <br>
                 <p>CVR: 38101773</p>
                 <p>Bank: Nordea 2409-6284325069</p>
        </div><!--access wrapper-->
        <!-- Modal -->

      </div> <!--/Signup--> 
        <!--Login-->
      
        <div class="col-sm-12 col-lg-8  m-t-30">
                <div class="access-wrapper dark-grey">
                    <h1>Skriv til os</h1>
                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="sign-up-form">
                        <div class="row m-t-20">
                            <div class="col-lg-2">
                                <p>Navn*:</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="contact_name" id="contact_name">
                                
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="CONTACT-US"/>
                            <div class="col-lg-2">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" name="contact_email" id="contact_email">
                               <!--  <small class="pull-right form-feedback">Minimum otte tegn.</small>-->
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-2">
                                <p>Besked*:</p>
                            </div>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="8" id="contact_msg" name="contact_msg"></textarea>
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <div class="col-lg-2">
                                <p></p>
                            </div>
                        	<div class="col-lg-10">
                            	<button type="submit" class="btn btn-primary" style="margin:0 auto; display:block; float:none">
                                	Send
                                </button>
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
<br>



<!--Terms and Condition Popup-->
<?php require_once('libs/terms-and-conditons.php') ?>
<!--/Terms and Condition-->

<!--Forget Password-->
	<?php require_once('libs/forget-password.php'); ?>
<!--/Forget Password-->

<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN - Kontakt os');
        $('head').append('<meta name="description" content="IVN.dk er skabt af iværksættere for iværksættere. Derfor kan I være med til at forme IVN.dk. Skriv til os med forslag og idéer.">');
        $('head').append('<meta name="keywords" content="Iværksætter, iværksættere, iværksætteri, forretninger, start-up, virksomhedsopstart, Iværksætter Netværk, netværk, networking">');
    });
</script>

