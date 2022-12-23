<!--Response-->
	<?php require_once('libs/response.php') ?>
<!--response-->
<footer class="container-fluid text-center">
  <p> Copyright ©  IVN.dk</p>
</footer>
<script src="assets/js/ivn.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.jquery.min.js"></script>
 <script>        
  var mySwiper = new Swiper ('.swiper-container', {
    
    // If we need pagination
    pagination: '.swiper-pagination',
	paginationClickable:true,
	loop:true,
	autoplay: 3000,
	speed:700,
    
    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    
  });
  mySwiper.enableKeyboardControl();
  mySwiper.enableTouchControl();   
  </script>
  <script>
  $("#d_login").click(function() {
	$('html, body').animate({
        scrollTop: $(".login_point").offset().top - 100
    }, 2000);
});
  </script>
</body>
</body></html>