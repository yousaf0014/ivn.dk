<body>
	<table cellpadding="10" cellspacing="0">
		<tr>
			<td>{{date('m/d/Y')}}</td>
			<td>
				<div style="float:right"><img src="{{ asset('images/img-ivn-contact-us.jpg') }}"></div>
				<div style="clear:both"></div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h3>Opret indløsningaftale</h3>
				<h2>Firmaoplysninger</h2>
				<p>Hvorfor spørger vi om dette?” Vi har behov for at vide præcis, hvem vi ingår en aftale med.</p>				
				<hr>
			</td>
		</tr>
		<tr>
			<td>Land</td>
			<td>{{!empty($land) ? $land:''}}</td>
		</tr>

		<tr>
			<td>CVR nr.</td>
			<td>{{!empty($CVR_nr_) ? $CVR_nr_:''}}</td>
		</tr>

		<tr>
			<td>Firmanavn</td>
			<td>{{!empty($Firmanavn) ? $Firmanavn:''}}</td>
		</tr>

		<tr>
			<td>Adresse</td>
			<td>{{!empty($Adresse) ? $Adresse:''}}</td>
		</tr>

		<tr>
			<td>Postnummer</td>
			<td>{{!empty($Postnummer) ? $Postnummer:''}}</td>
		</tr>
		<tr>
			<td>By</td>
			<td>{{!empty($By) ? $By:''}}</td>
		</tr>
		<tr>
			<td>Telefon</td>
			<td>{{!empty($Telefon) ? $Telefon:''}}</td>
		</tr>
		<tr>
			<td>Hvornår træffes du bedst?</td>
			<td>{{!empty($Hele_dagen) ? $Hele_dagen:''}}</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>
		<tr>
			<td colspan="2">
				<h2>Firmaoplysninger</h2>
				<p>
					Hvorfor sporger vi om dette? Vi har behov for at vide praecis. hvem vi indgar an aftate med.
				</p>
				<hr>
			</td>
		</tr>

		<tr>
			<td>Fulde navn</td>
			<td>{{!empty($Fulde_navn) ? $Fulde_navn:''}}</td>
		</tr>
		<tr>
			<td>CPR nr.</td>
			<td>{{!empty($CPR_nr_1) ? $CPR_nr_1:''}}</td>
		</tr>
		<tr>
			<td>Adresse</td>
			<td>{{!empty($Adresse) ? $Adresse:''}}</td>
		</tr>
		<tr>
			<td>Postnummer</td>
			<td>{{!empty($Postnummer) ? $Postnummer:''}}</td>
		</tr>
		<tr>
			<td>By</td>
			<td>{{!empty($By1) ? $By1:''}}</td>
		</tr>
		<tr>
			<td>Land</td>
			<td>{{!empty($land1) ? $land1:''}}</td>
		</tr>
		<tr>
			<td>Billedlegitimation</td>
			<td>{{!empty($Billedlegitimation) ? $Billedlegitimation:''}}</td>
		</tr>
		<tr>
			<td colspan="2">
				Eksempler: pas, kørekort
			</td>
		</tr>
		<tr>
			<td>Adresselegitimation</td>
			<td>{{!empty($Adresselegitimation) ? $Adresselegitimation:''}}</td>
		</tr>
		<tr>
			<td colspan="2">Eksempel: sygesikringsbevis<td>
		</tr>

		<tr>
			<td colspan="2">
				<h2>Ejerforhold</h2>
				<p>
					Hvorfor spørger vi om dette? Ifølge reglerne om anti-hvidvask er vi forpligtede til at kende enhver person, der direkte eller indirekte ejer eller kontrollerer mere end 25% af firmaet.
				</p>
			<td>
		</tr>
		<?php if(!empty($Ejerforhold)){ ?>
			<tr>
				<td>Ejerforhold</td>
				<td><?php
					
						if($Ejerforhold == 1){
							echo 'Firmaet er en enkeltmandsvirksomhed ejet af direktøren';
						}else if($Ejerforhold == 2){
							echo 'Firmaet er en enkeltmandsvirksomhed, der ejes af en anden end direktøren';
						}else if($Ejerforhold == 3){
							echo 'En eller flere ejere (direkte såvel som indirekte) har 25% eller mere af selskabet';
						}else if($Ejerforhold == 4){
							echo 'Ingen personer ejer direkte eller indirekte 25% af selskabet';
						}
					
					?>	
				</td>
			</tr>
			<?php if($Ejerforhold == 2 || $Ejerforhold == 3){ ?>
				<tr>
					<td colspan="2">
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
							<td><?php echo $navn3; ?></td>
							<td><?php echo $CPR_nr_3; ?></td>
							<td><?php echo $adr3; ?></td>
							<td><?php echo $Post_nr_3; ?></td>
							<td><?php echo $By3; ?></td>
							<td><?php echo $land3; ?></td>
						</tr>
						<?php if(!empty($navn4)){ ?>
							<tr>
								<td><?php echo $navn4; ?></td>
								<td><?php echo $CPR_nr_4; ?></td>
								<td><?php echo $adr4; ?></td>
								<td><?php echo $Post_nr_4; ?></td>
								<td><?php echo $By4; ?></td>
								<td><?php echo $land4; ?></td>
							</tr>
						<?php } ?>
					</table>
					</td>
				</tr>
				<?php if($Ejerforhold == 2){ ?>
				<tr>
					<td>Tilføj information om den, der ejer af firmaet.</td>
					<td>
						<?php echo $Tilfoj; ?>
					</td>
				</tr>
				<tr>
					<td>Billedlegitimation af alle øvrige medejere</td>
					<td> 
						<?php echo $ovrige; ?>
					</td>
				</tr>
				<?php } ?>
			<?php }else if($Ejerforhold == 4){ ?>
			<tr>
				<td>Venligst forklar ejerstrukturen</td>
				<td><?php echo $Ejerforhold_details;?></td>
			</tr>
			<?php } ?>


			<?php if($Ejerforhold == 3){ ?>
				<tr>
					<td>Tilføj information om den, der ejer af firmaet.</td>
					<td>
						<?php echo $Vælg_filer; ?>
					</td>
				</tr>
				<tr>
					<td>Billedlegitimation af alle øvrige medejere</td>
					<td> 
						<?php echo $ovrige1; ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
		<tr>
			<td colspan="2">				
				<h2>Hjemmeside</h2>
				<p>
					Hvad er jeres hjemmeside og er den allerede tilgængelig online?
				</p>
				<hr>
			</td>
		</tr>
		<tr>
			<td>Hjemmeside</td>
			<td><?php echo !empty($Hjemmeside) ? $Hjemmeside:'';?></td>
		</tr>
		<tr>
			<td>Er hjemmesiden i drift?</td>
			<td><?php echo !empty($hjemmesiden_radio) && $hjemmesiden_radio == 0 ? 'Ja':'Nej';?></td>
		</tr>
		<?php if( !empty($hjemmesiden_radio) && $hjemmesiden_radio == 1){ ?>
		<tr>
			<td>Test-hjemmeside</td>
			<td><?php echo !empty($Test_hjemmeside) ? $Test_hjemmeside:'';?></td>
		</tr>
		<tr>
			<td>Test-brugernavn</td>
			<td><?php echo !empty($Test_brugernavn) ? $Test_brugernavn:'';?></td>
		</tr>

		<tr>
			<td>Test-adgangskode</td>
			<td><?php echo ($Test_adgangskode) ? $Test_adgangskode:'';?></td>
		</tr>
		<?php } ?>
		<tr>
			<td>Betalingsgateway</td>
			<td><?php echo !empty($Betalingsgateway) ? $Betalingsgateway:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Vælg hvilken psp pakke (Basis, Iværksætter, Business, Pro, Enterprise) du ønsker. Er du i tvivl, så vælge "Få et tilbud", eller ring på tlf. +45 77 344 388 eller skriv til os på support@pensopay.com</p>
			</td>
		</tr>
		<tr>
			<td>Webshop system</td>
			<td><?php echo !empty($Webshop_system) ? $Webshop_system:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Vælg hvilket webshop system du benytter dig af.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">				
				<h2>Forretningsmodel</h2>
				<p>
					Hvorfor spørger vi om dette? Beskriv venligst din forretningsmodel og hvad du sælger
				</p>
				<hr>
			</td>
		</tr>
		<tr>
			<td>Forretningsnavn</td>
			<td><?php echo !empty($Forretningsnavn) ? $Forretningsnavn:'';?></td>
		</tr>

		<tr>
			<td>Hvad sælger i?</td>
			<td><?php echo !empty($Hvad_sælger_i) ? $Hvad_sælger_i:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Hvad sælger/yder i?</p>
			</td>
		</tr>
		<tr>
			<td>Vi har abonnementsbetalinger</td>
			<td><?php echo !empty($Vi_har_abonnementsbetalinger) ? 'Yes':'';;?></td>
		</tr>
		<tr>
			<td>Vi har fysisk levering af varer</td>
			<td><?php echo !empty($Vi_har_fysisk_levering_af_varer) ? 'Yes':'';?></td>
		</tr>
		<?php if(!empty($Vi_har_fysisk_levering_af_varer)){ ?>
		<tr>
			<td>Leveringstid</td>
			<td><?php echo !empty($Leveringstid) ? $Leveringstid:'';?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="2">				
				<p>Venligst estimer dit forventede gennemsnitlige ordrestørrelse og månedlige omsætning.</p>
			</td>
		</tr>
		<tr>
			<td>Valuta</td>
			<td><?php echo !empty($Valuta) ? $Valuta:'';?></td>
		</tr>
		<tr>
			<td>Månedlig/Forventet omsætning</td>
			<td><?php echo !empty($Månedlig_Forventet_omsætning) ? $Månedlig_Forventet_omsætning:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Gennemsnit</p>
			</td>
		</tr>
		<tr>
			<td>Ordrestørrelse/Forventet</td>
			<td><?php echo !empty($Ordrestørrelse_Forventet) ? $Ordrestørrelse_Forventet:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Gennemsnit</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">				
				<h2>Bankkonto</h2>
				<p>
					Hvorfor spørger vi om dette? Ved os kan du acceptere betalinger fra dine kunder i alle valutaer. Du kan få udbetalinger fra os i følgende valutaer: DKK, EUR, SEK, NOK, GBP og USD.
				</p>
				<hr>
			</td>
		</tr>
		<tr>
			<td>Valuta</td>
			<td><?php echo !empty($Valuta1) ? $Valuta1:'';?></td>
		</tr>
		<tr>
			<td>Bank</td>
			<td><?php echo !empty($Bank) ? $Bank:'';?></td>
		</tr>
		<tr>
			<td>Faktura mail</td>
			<td><?php echo !empty($Faktura_mail) ? $Faktura_mail:'';?></td>
		</tr>
		<tr>
			<td>SWIFT (BIC) kode</td>
			<td><?php echo !empty($SWIFT_BIC_kode) ? $SWIFT_BIC_kode:'';?></td>
		</tr>
		<tr>
			<td>IBAN nummer</td>
			<td><?php echo !empty($iban) ? $iban:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<b>Yderligere oplysninger </b>
 				<p> Hvis du tænker vi har behov for yderligere oplysninger kan du angive det her. </p>
			</td>
		</tr>
		<tr>
			<td>Yderligere oplysninger</td>
			<td><?php echo !empty($Yderligere_oplysninger) ? $Yderligere_oplysninger:'';?></td>
		</tr>
		<tr>
			<td>Hvor hørte du om PensoPay*</td>
			<td><?php echo !empty($PensoPay) ? $PensoPay:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<p>Vi kunne rigtig gerne tænke os at vide, hvor du har hørt om os, for at effektivere vores markedsføring.</p>
			</td>
		</tr>
		<tr>
			<td>Slip fil her ellervælg filer</td>
			<td><?php echo !empty($slip) ? $slip:'';?></td>
		</tr>
		<tr>
			<td colspan="2">				
				<h2>Handelsbetingelser</h2>
				<p>
					Vi beder dig venligst læse og acceptere vores handelsbetingelser. - Læs handelsbetingelser
				</p>
				<hr>
			</td>
		</tr>
		<tr>
			<td>Jeg accepterer og bekræfter jeg har læst handelsbetingelserne</td>
			<td><?php echo  !empty($Jeg_accepterer_og_bekræfter_jeg_har_læst_handelsbetingelserne) ? 'Yes':'';?></td>
		</tr>
		<tr>
			<td>Jeg accepterer at Pensopay godkender min indløsningsaftale og at jeg har 10 dages indsigelse.</td>
			<td><?php echo  !empty($Jeg_accepterer_at_Pensopay_godkender_min_indløsningsaftale_og_at_jeg_har_10_dages_indsigelse) ? 'Yes':'';?></td>
		</tr>
	</table>
</body>