<?php session_start (); include('header1.php') ?>
<div class="swiper-container" style="padding-top:80px;">
    <img src="assets/images/comingsoon.png">
</div>
<?php include('footer.php') ?>
<!--- Append Meta Tags and Description using jquery-->
<script type="text/javascript">
    $(document).ready(function() {
        $('head').append('<meta name="description" content="IVN.dk er det n�ste skridt for facebook gruppen Iv�rks�tter Netv�rk. 40.000 medlemmer giver de bedst mulige vilk�r for at skabe en platform, der d�kker alle iv�rks�tteriets behov. Opret din personlige profil i dag og v�r med til at forme IVN.dk.">');
        $('head').append('<meta name="keywords" content="Iv�rks�tter, iv�rks�ttere, iv�rks�tteri, forretninger, start-up,virksomhedsopstart, Iv�rks�tter Netv�rk, netv�rk, networking">');
    });
</script>
