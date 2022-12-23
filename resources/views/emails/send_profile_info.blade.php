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
				<p>Du har bedt om indsigt i, hvilke informationer vi har lagret om dig.</p>
				<p>Dem finder du her</p>				
			</td>
		</tr>

		<tr>
			<td>
				Fornavn
			</td>
			<td>{{$user['first_name']}}</td>
		</tr>

		<tr>
			<td>
				Efternavn
			</td>
			<td>{{$user['last_name']}}</td>
		</tr>

		<tr>
			<td>
				E-mail
			</td>
			<td>{{$user['email']}}</td>
		</tr>

		<tr>
			<td>
				Adresse 1
			</td>
			<td>{{$user['address']}}</td>
		</tr>

		<tr>
			<td>
				Hus nr.
			</td>
			<td>{{$user['housenumber']}}</td>
		</tr>


		<tr>
			<td>
				Adresse 2
			</td>
			<td>{{$user['address2']}}</td>
		</tr>

		<tr>
			<td>
				Post nr.
			</td>
			<td>{{$user['zipcode']}}</td>
		</tr>

		<tr>
			<td>
				By:
			</td>
			<td>{{$user['city']}}</td>
		</tr>

		<tr>
			<td>
				Telefonnummer
			</td>
			<td>{{$user['mobile']}}</td>
		</tr>

		<tr>
			<td>
				Land
			</td>
			<td>{{$user['country']}}</td>
		</tr>
		<tr>
			<td>
				Fødselsdato
			</td>
			<td>{{!empty($user['date_of_birth']) ? YMD2MDY($user['date_of_birth']):''}}</td>
		</tr>
		<tr>
			<td>
				Køn
			</td>
			<td>{{$user['gender'] == 'male' ? 'Mand':'Kvinde'}}</td>
		</tr>
		<tr>
			<td>
				Titel
			</td>
			<td>{{$user['job_title']}}</td>
		</tr>
		<tr>
			<td>
				Primær beskæftigelse
			</td>
			<td>
				<?php 
				if($user['primary_occupation'] == 'selfemployed'){
					echo 'Selvstændig';
				}else if($user['primary_occupation'] == 'student'){
					echo 'Studerende';
				}else if($user['primary_occupation'] == 'employed'){
					echo 'Lønmodtager';
				}
				?>
			</td>
		</tr>

		<tr>
			<td>
				Tilknytning
			</td>
			<td>
				<?php 
				if($user['entrepreneurial_status'] == 'entrepreneur'){
					echo 'Jeg er iværksætter';
				}else if($user['entrepreneurial_status'] == 'entrepreneur_soon'){
					echo 'Jeg bliver snart iværksætter';
				}else if($user['entrepreneurial_status'] == 'interested_entrepreneurship'){
					echo 'Jeg er interesseret i iværksætteri';
				}
				?>
			</td>
		</tr>

		<?php if(!empty($company)){ ?>
			<tr><td colspan="2"><h2>Min virksomhed</h2></td></tr>

			<tr>
				<td>
					Firmanavn
				</td>
				<td>{{$company['name']}}</td>
			</tr>

			<tr>
				<td>
					Selskabsform
				</td>
				<td>
					<?php 
					if($company['type'] == 'I/S'){
						echo 'I/S';
					}else if($company['type'] == 'IVS'){
						echo 'IVS';
					}else if($company['type'] == 'ApS'){
						echo 'ApS';
					}else if($company['type'] == 'A/S'){
						echo 'A/S';
					} 
					?></td>
			</tr>
			<tr>
				<td>
					CVR
				</td>
				<td>{{$company['cvr']}}</td>
			</tr>
			<tr>
				<td>
					Adresse 1
				</td>
				<td>{{$company['address1']}}</td>
			</tr>

			<tr>
				<td>
					Hus nr.
				</td>
				<td>{{$company['house_no']}}</td>
			</tr>

			<tr>
				<td>
					Adresse 2
				</td>
				<td>{{$company['address2']}}</td>
			</tr>

			<tr>
				<td>
					Post nr
				</td>
				<td>{{$company['zip']}}</td>
			</tr>

			<tr>
				<td>
					By
				</td>
				<td>{{$company['city']}}</td>
			</tr>

			<tr>
				<td>
					E-mail
				</td>
				<td>{{$company['email']}}</td>
			</tr>

			<tr>
				<td>
					WWW
				</td>
				<td>{{$company['url']}}</td>
			</tr>

			<tr>
				<td>
					Tilknytning
				</td>
				<td>
					<?php 
					if($company['entrepreneurial_status'] == 'entrepreneur'){
						echo 'Jeg er iværksætter';
					}else if($company['entrepreneurial_status'] == 'entrepreneur_soon'){
						echo 'Jeg bliver snart iværksætter';
					}else if($company['entrepreneurial_status'] == 'interested_entrepreneurship'){
						echo 'Jeg er interesseret i iværksætteri';
					} 
					?></td>
			</tr>

			<tr>
				<td>
					Ugentligt timetal
				</td>
				<td>{{$company['job_type'] == 'full_time' ? 'Fuldtid':'Deltid'}}</td>
			</tr>
		<?php } ?>

		<tr>
			<td colspan="2">
				<br />
				<br />
				<p>Mvh</p>
				<p><b>IVN</b></p>
			</td>
		</tr>
	</table>
</body>