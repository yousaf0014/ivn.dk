<?php include('header.php') ?>
<!--Slider-->
<section>

        <div class="fill mobile" style="background-image:url('assets/images/find-din-pris.png');"></div>
        <div class="desktop"><img src="assets/images/find-din-pris.png" style="max-height:551px;"/></div>
</section>
<!--Logedin Home Page-->
<section class="offwhite">
  <div class="container">
  		<div class="row tp-padding">
          	<div class="col-lg-12" style="min-height: 600px">
                <div id="load_prisber"><img src="assets/images/loading.gif" /></div>
                <iframe src="https://thagaard.org/ivn-prisberegner/" style="border:0px" height="600px" width="100%"
                onload="document.getElementById('load_prisber').style.display='none';"></iframe>
            </div>
      </div>
  </div>
</section>
<!--Logedin Home Page-->
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).prop('title', 'IVN - Tilbud: Bogen Coach');
        $('head').append('<meta name="description" content="Bogen Coach er en god guide til alle der vil starte op som Coach eller terapeut, men samtidig indeholder bogen en fyldig forklaring på mange af opstartsfasens faldgruber. Bogen sælges med rabat til alle IVN.dks medlemmer.">');
        $('head').append('<meta name="keywords" content="Iværksætter, iværksættere, iværksætteri, forretninger, start-up, virksomhedsopstart, Iværksætter Netværk, netværk, networking, bogen Coach, coaching">');
    });
</script>