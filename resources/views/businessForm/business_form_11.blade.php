<style type="text/css">
	div.validation_error {
    color: #790000;
    font-size: 1em;
    font-weight: 700;
    margin-bottom: 25px;
    border-top: 2px solid #790000;
    border-bottom: 2px solid #790000;
    padding: 16px 0;
    clear: both;
    width: 100%;
    text-align: center;
}
</style>
<form action="{{url('saveuserBusiness11')}}" method="post" id="businessForm"enctype="multipart/form-data">
	<input type="hidden" name="business" value="<?php echo  $business->id;?>"> 
	{{ csrf_field() }}
	<h3>Opret indløsningaftale</h3>

	<div class="validation_error" style="display:none">Der var et problem med din indsendelse. Felter markeret med * kræver din opmærksomhed.</div>
	<h2>Firmaoplysninger</h2>
	<p>
		Hvorfor spørger vi om dette? Vi har behov for at vide præcis, hvem vi indgår en aftale med.
	</p>
	<hr>
	<div class="form-field">
		<label for="">Land</label>
		<div class="field-element">
			<select name="land" class="field-item" required="true">
				<option value="">-- Vælg land --</option>
				<?php foreach($countries as $con){ ?>
					<option value="{{$con->name}}">{{$con->name}}</option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-field">
		<label for="">CVR nr.</label>
		<div class="field-element">
			<input type="text" name="CVR nr." placeholder="CVR nr." class="field-item" required="true">
		</div>
	</div>

	<div class="form-field">
		<label for="">Firmanavn</label>
		<div class="field-element">
			<input type="text" name="Firmanavn" placeholder="Firmanavn" class="field-item" required="true">
		</div>
	</div>

	<div class="form-field">
		<label for="">Adresse</label>
		<div class="field-element">
			<input type="text" name="Adresse" placeholder="Adresse" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Postnummer</label>
		<div class="field-element">
			<input type="text" name="Postnummer" placeholder="Postnummer" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">By</label>
		<div class="field-element">
			<input type="text" name="By" placeholder="By" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Telefon</label>
		<div class="field-element">
			<input type="text" name="Telefon" placeholder="Telefon" class="field-item" number minlength="8" maxlength="8" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Hvornår træffes du bedst?</label>
		<div class="field-element">
			<select name="Hele_dagen" class="medium gfield_select field-item" tabindex="8" aria-invalid="false" required="true">
				<option value="" selected="selected">Hele dagen</option>
				<option value="08:00 - 12:00">08:00 - 12:00</option>
				<option value="12:00 - 16:00">12:00 - 16:00</option>
				<option value="16:00 - 20:00">16:00 - 20:00</option>
			</select>
		</div>
	</div>
	<div class="form-field">
		<label for="">E-mail</label>
		<div class="field-element">
			<input type="text" name="email" placeholder="E-mail" class="field-item" required="true" email="true">
		</div>
	</div>
	<h2>Firmaoplysninger</h2>
	<p>
		Hvorfor spørger vi om dette? Vi har behov for at vide præcis, hvem vi indgår en aftale med.
	</p>
	<hr>
	<div class="form-field">
		<label for="">Fulde navn</label>
		<div class="field-element">
			<input type="text" name="Fulde_navn" placeholder="Fulde navn" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">CPR nr.</label>
		<div class="field-element">
			<input type="text" name="CPR_nr.1" placeholder="CPR nr." class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Adresse</label>
		<div class="field-element">
			<input type="text" name="adresse1" placeholder="Adresse" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Postnummer</label>
		<div class="field-element">
			<input type="text" name="Postnummer1" placeholder="Postnummer" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">By</label>
		<div class="field-element">
			<input type="text" name="By1" placeholder="By" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Land</label>
		<div class="field-element">
			<select name="land1" class="field-item" required="true" required="true">
				<option value="">-- "Vælg land --</option>
				<?php foreach($countries as $con){ ?>
					<option value="{{$con->name}}">{{$con->name}}</option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-field">
		<label for=""></label>
		<div class="field-element">
			<p>Venligst upload et officielt dokument med direktørens billede og adresse. </p>
		</div>
	</div>

	<div class="form-field">
		<label for="">Billedlegitimation</label>
		<div class="field-element">
			<input type="file" name="Billedlegitimation" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for=""></label>
		<div class="field-element">
			Eksempler: pas, kørekort
		</div>
	</div>
	<div class="form-field">
		<label for="">Adresselegitimation</label>
		<div class="field-element">
			<input type="file" name="Adresselegitimation" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for=""></label>
		<div class="field-element">
			Eksempel: sygesikringsbevis
		</div>
	</div>
	<h2>Ejerforhold</h2>
	<p>
		Hvorfor spørger vi om dette? Ifølge reglerne om anti-hvidvask er vi forpligtede til at kende enhver person, der direkte eller indirekte ejer eller kontrollerer mere end 25% af firmaet.
	</p>
	<hr>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="radio" name="Ejerforhold" value="1" onchange="showRefBox(1)" required="true">&nbsp;
			Firmaet er en enkeltmandsvirksomhed ejet af direktøren
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="radio" name="Ejerforhold" value="2" onchange="showRefBox(2)" required="true">&nbsp;
			Firmaet er en enkeltmandsvirksomhed, der ejes af en anden end direktøren
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="radio" name="Ejerforhold" value="3" onchange="showRefBox(3)" required="true">&nbsp;
			En eller flere ejere (direkte såvel som indirekte) har 25% eller mere af selskabet
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="radio" name="Ejerforhold" value="4" onchange="showRefBox(4)" required="true">&nbsp;
			Ingen personer ejer direkte eller indirekte 25% af selskabet
		</div>
	</div>
	<script>
		function showRefBox(refID){

			if(refID == '1'){
				$("#box-option-2").slideUp("slow",function ()
			    {
			       $("#box-option-2").hide();
			    });

			    $("#box-option-4").slideUp("slow",function ()
			   {
				 $("#box-option-4").hide();
			   });

			   $("#box-option-3").slideUp("slow",function ()
			  {
			     $("#box-option-3").hide();
			  });
			}
			if(refID == '2'){
				$("#box-option-4").slideUp("slow",function ()
				   {
					 $("#box-option-4").hide();
				   });

			   $("#box-option-3").slideUp("slow",function ()
			 {
			    $("#box-option-3").hide();
			 });

				$("#box-option-2").slideDown("slow",function ()
			    {
			       $("#box-option-2").show();
			    });
			}

			if(refID == '3'){

				$("#box-option-2").slideUp("slow",function ()
			    {
				  $("#box-option-2").hide();
			    });

			    $("#box-option-4").slideUp("slow",function ()
			   {
				 $("#box-option-4").hide();
			   });

				$("#box-option-3").slideDown("slow",function ()
			    {
			       $("#box-option-3").show();
			    });
			}

			if(refID == '4'){

				$("#box-option-2").slideUp("slow",function ()
			    {
				  $("#box-option-2").hide();
			    });

			    $("#box-option-3").slideUp("slow",function ()
			   {
				 $("#box-option-3").hide();
			   });


				$("#box-option-4").slideDown("slow",function ()
			    {
			       $("#box-option-4").show();
			    });
			}
		}
	</script>

	<!-- for 2nd option -->
	<div class="form-field" id="box-option-2" style="display:none;">
		<label for=""></label>
		<div class="field-element">
			<table>
				<tr>
					<th>Navn</th>
					<th>CPR nr.</th>
					<th>Adr.</th>
					<th>Post nr.</th>
					<th>By</th>
					<th>Land</th>
				</tr>
				<tr>
					<td><input type="text" name="navn3" value="" class="field-item"></td>
					<td><input type="text" name="CPR nr.3" value="" class="field-item"></td>
					<td><input type="text" name="adr3" value="" class="field-item"></td>
					<td><input type="text" name="Post nr.3" value="" class="field-item"></td>
					<td><input type="text" name="By3" value="" class="field-item"></td>
					<td><input type="text" name="land3" value="" class="field-item"></td>
				</tr>
			</table>
		</div>
		<div class="clearfix"></div>
		<div class="form-field">
			<br>
			<label for="">&nbsp;</label>
			<div class="field-element">
				<p>Tilføj information om den, der ejer af firmaet.</p>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="form-field">
			<label for=""></label>
			<div class="field-element">
				<input type="file" name="Tilfoj" placeholder="">
				<br>
				<p>Billedlegitimation</p>
			</div>
		</div>


		<div class="clearfix"></div>

		<div class="form-field">
			<label for=""></label>
			<div class="field-element">
				<input type="file" name="ovrige" placeholder="">
				<br>
				<p>Adresselegitimation</p>
			</div>
		</div>


	</div>

	<!-- for option three -->
	<div class="form-field" id="box-option-3" style="display:none;">
		<label for=""></label>
		<div class="field-element">
			<table>
				<tr>
					<th>Navn</th>
					<th>CPR nr.</th>
					<th>Adr.</th>
					<th>Post nr.</th>
					<th>By</th>
					<th>Land</th>
					<th style="width:55px;"></th>
				</tr>
				<tr>
					<td><input type="text" name="navn3" value="" class="field-item"></td>
					<td><input type="text" name="CPR nr.3" value="" class="field-item"></td>
					<td><input type="text" name="adr3" value="" class="field-item"></td>
					<td><input type="text" name="Post nr.3" value="" class="field-item"></td>
					<td><input type="text" name="By3" value="" class="field-item"></td>
					<td><input type="text" name="land3" value="" class="field-item"></td>
					<td>
						<!-- <div class="btnAdder" onclick="insertRow();"><span class="fa fa-plus"></span></div>
						<div class="btnRemover" style="display:block;"><span class="fa fa-minus"></span></div> -->
					</td>
				</tr>

				<tr>
					<td><input type="text" name="navn4" value="" class="field-item"></td>
					<td><input type="text" name="CPR nr.4" value="" class="field-item"></td>
					<td><input type="text" name="adr4" value="" class="field-item"></td>
					<td><input type="text" name="Post nr.4" value="" class="field-item"></td>
					<td><input type="text" name="By4" value="" class="field-item"></td>
					<td><input type="text" name="land4" value="" class="field-item"></td>
					<td>
						<!-- <div class="btnAdder" onclick="insertRow();" style="display:none;"><span class="fa fa-plus"></span></div>
						<div class="btnRemover" style="display:block;"><span class="fa fa-minus"></span></div> -->
					</td>
				</tr>
			</table>

			<script>

			</script>

			<div class="clearfix"></div>


			<p style="margin-top:20px;">Tilføj information om den, der ejer af firmaet.</p>

			<div class="brdr-dashed-box">
				<p>Slip fil her ellervælg filer</p>
				<div class="clearfix"></div>
				<input type="file" name="Vælg_filer" placeholder="Vælg filer" value="">
			</div>

			<p style="margin-top:20px;">Billedlegitimation af alle øvrige medejere.</p>

			<div class="brdr-dashed-box">
				<p>Slip fil her eller vælg filer</p>
				<div class="clearfix"></div>
				<input type="file" name="ovrige1" placeholder="Vælg filer" value="">
			</div>

			<p style="margin-top:20px;">Adresselegitimation af alle øvrige medejere</p>


		</div>
	</div>

	<!-- for 4rth option -->
	<div class="form-field" id="box-option-4" style="display:none;">
		<label for="">Venligst forklar ejerstrukturen</label>
		<div class="field-element">
			<textarea rows="5" name="Ejerforhold_details" class="field-item"placeholder="Ejerstruktur" required="true"></textarea>
		</div>
	</div>




	<h2>Hjemmeside</h2>
	<p>
		Hvad er jeres hjemmeside og er den allerede tilgængelig online?
	</p>
	<hr>
	<div class="form-field">
		<label for="">Hjemmeside</label>
		<div class="field-element">
			<textarea name="Hjemmeside" class="field-item" rows="5" required="true"></textarea>
			<p>
				Flere hjemmesider? Hvis du har flere side som omhandler det samme, kan du skrive dem under hinanden.
			</p>
		</div>
	</div>
	<div class="form-field">
		<label for="">Er hjemmesiden i drift?</label>
		<div class="field-element">
			<input type="radio" name="hjemmesiden_radio" value="0" onchange="hjemmesidenValue(0)" required="true">&nbsp; Ja
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="radio" name="hjemmesiden_radio" value="1" onchange="hjemmesidenValue(1)" required="true">&nbsp;Nej
		</div>
	</div>

	<div class="clearfix" id="hjemmesidenHiddenDiv" style="display:none;">
		<div class="form-field">
			<label for="">Test-hjemmeside</label>
			<div class="field-element">
				<input type="text" name="Test_hjemmeside" value="" placeholder="Test-hjemmeside" class="field-item" required="true">
			</div>
		</div>
		<div class="form-field">
			<label for="">Test-brugernavn</label>
			<div class="field-element">
				<input type="text" name="Test_brugernavn" value="" placeholder="Test-brugernavn" class="field-item" required="true">
			</div>
		</div>
		<div class="form-field">
			<label for="">Test-adgangskode</label>
			<div class="field-element">
				<input type="text" name="Test_adgangskode" placeholder="Test-adgangskode" value="" class="field-item" required="true">
			</div>
		</div>
	</div>

	<script>
		function hjemmesidenValue(refID){
			if(refID == '1'){
				$("#hjemmesidenHiddenDiv").slideDown("slow",function ()
			    {
			       $("#hjemmesidenHiddenDiv").show();
			    });
		    }else{
			    $("#hjemmesidenHiddenDiv").slideUp("slow",function ()
			   {
				 $("#hjemmesidenHiddenDiv").hide();
			   });
		    }
		}
	</script>

	<div class="form-field">
		<label for="">Betalingsgateway</label>
		<div class="field-element">
			<select name="Betalingsgateway" class="field-item" required="true">
				<option value="" class="gf_placeholder">-- Vælg Pakke --</option>
				<option value="Business - Kr. 99/md. inkl. 100 trans./md.">Business - Kr. 99/md. inkl. 100 trans./md.</option>
				<option value=""></option>
				<option value="Pro - Kr. 149/md. inkl. 250 trans./md.">Pro - Kr. 149/md. inkl. 250 trans./md.</option>
				<option value="Iværksætter - Kr. 59/md. + kr. 1,-/trans.">Iværksætter - Kr. 59/md. + kr. 1,-/trans.</option>
				<option value="Enterprise - Kr. 249/md. inkl. 500 trans./md">Enterprise - Kr. 249/md. inkl. 500 trans./md</option>
				<option value="Basis - Kr. 0/md. + kr. 4,-/trans.">Basis - Kr. 0/md. + kr. 4,-/trans.</option>
				<option value="Få et tilbud">Få et tilbud</option>
				<option value="Har allerede en betalingsgateway">Har allerede en betalingsgateway</option>
			</select>

		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<p>Vælg hvilken psp pakke (Basis, Iværksætter, Business, Pro, Enterprise) du ønsker. Er du i tvivl, så vælge "Få et tilbud", eller ring på tlf. +45 77 344 388 eller skriv til os på support@pensopay.com</p>
		</div>
	</div>
	<div class="form-field">
		<label for="">Webshop system</label>
		<div class="field-element">
			<select name="Webshop_system" class="field-item" required="true">
				<option value="" selected="selected" class="gf_placeholder">-- Vælg Webshop System --</option>
				<option value="Wordpress/WooCommerce">Wordpress/WooCommerce</option>
				<option value="Magento 1.9x">Magento 1.9x</option>
				<option value="Prestashop">Prestashop</option>
				<option value="Shopify">Shopify</option>
				<option value="Andet">Andet</option>
				<option value="Arastta">Arastta</option>
				<option value="CB Paid">CB Paid</option>
				<option value="Checkfront">Checkfront</option>
				<option value="cs.cart">cs.cart</option>
				<option value="Drupal Commerce">Drupal Commerce</option>
				<option value="EasyDigitalDownloads">EasyDigitalDownloads</option>
				<option value="Event Booking">Event Booking</option>
				<option value="Event Espresso">Event Espresso</option>
				<option value="FujiFilm imagine">FujiFilm imagine</option>
				<option value="HikaShop">HikaShop</option>
				<option value="J2 Store">J2 Store</option>
				<option value="Loaded Commerce">Loaded Commerce</option>
				<option value="Magento 2.x">Magento 2.x</option>
				<option value="nopCommerce">nopCommerce</option>
				<option value="opencart">opencart</option>
				<option value="osCommerce">osCommerce</option>
				<option value="Payplans">Payplans</option>
				<option value="Redshop">Redshop</option>
				<option value="Shopware">Shopware</option>
				<option value="SpreeCommerce">SpreeCommerce</option>
				<option value="TheCartPress">TheCartPress</option>
				<option value="Tomato Cart">Tomato Cart</option>
				<option value="Typo3MultiShop">Typo3MultiShop</option>
				<option value="ÜberCart">ÜberCart</option>
				<option value="uCommerce">uCommerce</option>
				<option value="Unique Free">Unique Free</option>
				<option value="VirtueMart">VirtueMart</option>
				<option value="WHMCS">WHMCS</option>
				<option value="Wordpress Ecommerce">Wordpress Ecommerce</option>
				<option value="Xcart">Xcart</option>
				<option value="ZenCart">ZenCart</option>
				<option value="---- Hosted systems ---">---- Hosted systems ---</option>
				<option value="Chargify">Chargify</option>
				<option value="DanDomain">DanDomain</option>
				<option value="EasyMe">EasyMe</option>
				<option value="Mono.net">Mono.net</option>
				<option value="ReePay">ReePay</option>
				<option value="Shoporama">Shoporama</option>
				<option value="Simplero">Simplero</option>
				<option value="SmartWeb">SmartWeb</option>
				<option value="TeaCommerce">TeaCommerce</option>
				<option value="WannaFind">WannaFind</option>
			</select>
		</div>
	</div>

	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			Vælg hvilket webshop system du benytter dig af.
		</div>
	</div>
	<h2>Forretningsmodel</h2>
	<p>
		Hvorfor spørger vi om dette? Beskriv venligst din forretningsmodel og hvad du sælger
	</p>
	<hr>
	<div class="form-field">
		<label for="">Forretningsnavn</label>
		<div class="field-element">
			<input type="text" name="Forretningsnavn" placeholder="Forretningsnavn" value="" class="field-item" required="true">
		</div>
	</div>

	<div class="form-field">
		<label for="">Hvad sælger i?</label>
		<div class="field-element">
			<textarea name="Hvad_sælger_i" placeholder="Hvad sælger i?" rows="5" class="field-item" required="true"></textarea>
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			Hvad sælger/yder i?
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="checkbox" name="Vi_har_abonnementsbetalinger" required="true" value="1" onchange="showHiddenlevering(0)">&nbsp;Vi har abonnementsbetalinger
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="checkbox" name="Vi_har_fysisk_levering_af_varer" required="true" value="1" id="chekBoxlevering2" onchange="showHiddenlevering(1)">&nbsp;Vi har fysisk levering af varer
		</div>
	</div>
	<div class="clearfix" style="display:none;" id="Hiddenlevering">
		<div class="form-field">
			<label for="">Leveringstid</label>
			<div class="field-element">
				<select name="Leveringstid" class="field-item" required="true">
					<option value="" selected="selected" class="gf_placeholder">-- Vælg leveringstid --</option>
					<option value="Mindre end 5 dage">Mindre end 5 dage</option>
					<option value="5 til 10 dage">5 til 10 dage</option>
					<option value="10 til 20 dage">10 til 20 dage</option>
					<option value="mere end 20 dage">mere end 20 dage</option>
				</select>
			</div>
		</div>
	</div>
	<script>
	function showHiddenlevering(refID){
		if(refID == '1'){
			if($("#chekBoxlevering2").prop("checked") == true){
				$("#Hiddenlevering").slideDown("slow",function ()
				    {
					  $("#Hiddenlevering").show();
				    });
	        } else {
			   $("#Hiddenlevering").slideUp("slow",function ()
			   {
				 $("#Hiddenlevering").hide();
			   });
	        }

	    }
	}
	</script>


	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
 			<p>Venligst estimer dit forventede gennemsnitlige ordrestørrelse og månedlige omsætning.</p>
 		</div>

	</div>
	<div class="form-field">
		<label for="">Valuta</label>
		<div class="field-element">
			<select name="Valuta" class="field-item" required="true">
				<option value="" selected="selected" class="gf_placeholder">-- Vælg valuta --</option>
				<option value="DKK">DKK</option>
				<option value="EUR">EUR</option>
				<option value="GBP">GBP</option>
				<option value="NOK">NOK</option>
				<option value="SEK">SEK</option>
				<option value="USD">USD</option>
			</select>
		</div>
	</div>
	<div class="form-field">
		<label for="">Månedlig/Forventet omsætning</label>
		<div class="field-element">
			<input type="text" name="Månedlig_Forventet_omsætning" required="true" placeholder="Månedlig/Forventet omsætning" value="" class="field-item">
		</div>
	</div>
	<div class="form-field">
		<label for="">Ordrestørrelse/Forventet</label>
		<div class="field-element">
			<input type="text" name="Ordrestørrelse_Forventet" required="true" placeholder="Ordrestørrelse/Forventet" value="" class="field-item">
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
 			<p>Gennemsnit</p>
 		</div>
	</div>

	<h2>Bankkonto</h2>
	<p>
		Hvorfor spørger vi om dette? Ved os kan du acceptere betalinger fra dine kunder i alle valutaer. Du kan få udbetalinger fra os i følgende valutaer: DKK, EUR, SEK, NOK, GBP og USD.
	</p>
	<hr>
	<div class="form-field">
		<label for="">Valuta</label>
		<div class="field-element">
			<select name="Valuta1" class="field-item" required="true">
				<option value="" selected="selected" class="gf_placeholder">-- Vælg valuta --</option>
				<option value="DKK">DKK</option>
				<option value="EUR">EUR</option>
				<option value="GBP">GBP</option>
				<option value="NOK">NOK</option>
				<option value="SEK">SEK</option>
				<option value="USD">USD</option>
			</select>
		</div>
	</div>
	<div class="form-field">
		<label for="">Bank</label>
		<div class="field-element">
			<input type="text" name="Bank" placeholder="Bank" value="" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">Faktura mail</label>
		<div class="field-element">
			<input type="text" name="Faktura_mail" placeholder="Faktura mail" value="" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">SWIFT (BIC) kode</label>
		<div class="field-element">
			<input type="text" name="SWIFT_BIC_kode" placeholder="SWIFT (BIC) kode" value="" class="field-item" required="true">
		</div>
	</div>
	<div class="form-field">
		<label for="">IBAN nummer</label>
		<div class="field-element">
			<input type="text" name="iban" placeholder="IBAN nummer" value="" class="field-item" required="true">
		</div>
	</div>

	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
 			<b>Yderligere oplysninger </b>
 			<p> Hvis du tænker vi har behov for yderligere oplysninger kan du angive det her. </p>
 		</div>
	</div>

	<div class="form-field">
		<label for="">Yderligere oplysninger</label>
		<div class="field-element">
			<textarea name="Yderligere_oplysninger" class="field-item" rows="5" required="true"></textarea>
		</div>
	</div>

	<div class="form-field">
		<label for="">Hvor hørte du om PensoPay*</label>
		<div class="field-element">
			<select name="PensoPay" class="field-item" required="true">
				<option value="" selected="selected" class="gf_placeholder">-- Vælg --</option>
				<option value="Fra omtale på Facebook">Fra omtale på Facebook</option>
				<option value="Fra en reklame på Facebook">Fra en reklame på Facebook</option>
				<option value="Fra Iværksætter Netværk (IVN)">Fra Iværksætter Netværk (IVN)</option>
				<option value="Fra Google">Fra Google</option>
				<option value="Fra LinkedIn">Fra LinkedIn</option>
				<option value="Anbefalet af mit netværk">Anbefalet af mit netværk</option>
				<option value="Fra mit Webbureau">Fra mit Webbureau</option>
				<option value="Jeg er en samarbejdspartner">Jeg er en samarbejdspartner</option>
				<option value="Andet">Andet</option>
			</select>
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
 			<p>Vi kunne rigtig gerne tænke os at vide, hvor du har hørt om os, for at effektivere vores markedsføring.</p>
 		</div>
	</div>

	<div class="form-field">
		<label for="">Fil</label>
		<div class="field-element">
			<div class="brdr-dashed-box">
				<p>Slip fil her eller vælg filer</p>
				<div class="clearfix"></div>
				<input type="file" name="slip" value="" placeholder="Fil" required="true">
			</div>
		
		</div>
	</div>
	<h2>Handelsbetingelser</h2>
	<p>
		Vi beder dig venligst læse og acceptere vores handelsbetingelser. - Læs handelsbetingelser
	</p>
	<hr>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="checkbox" required="true" name="Jeg_accepterer_og_bekræfter_jeg_har_læst_handelsbetingelserne" value="1">&nbsp;Jeg accepterer og bekræfter jeg har læst handelsbetingelserne
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="checkbox" required="true" name="Jeg_accepterer_at_Pensopay_godkender_min_indløsningsaftale_og_at_jeg_har_10_dages_indsigelse" value="1">&nbsp;Jeg accepterer at Pensopay godkender min indløsningsaftale og at jeg har 10 dages indsigelse.
		</div>
	</div>
	<div class="form-field">
		<label for="">&nbsp;</label>
		<div class="field-element">
			<input type="submit" name="Send" />
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#businessForm").validate({
	     debug:true,
	        invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {                       
                  $("div.validation_error").show();
                } else {
                  $("div.validation_error").hide();
                }
	        },
	   });
	});

	/*
	var */
</script>