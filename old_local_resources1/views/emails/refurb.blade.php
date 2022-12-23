<body>
	<table cellpadding="10" cellspacing="0" width="700px">
		<tr>
			<td>{{date('m/d/Y')}}</td>
			<td>
				<div style="float:right"><img src="{{ asset('images/img-ivn-contact-us.jpg') }}"></div>
				<div style="clear:both"></div>
			</td>
		</tr>
		<tr>
			<td colspan="2"><b>Få rabat når du køber IT</b></td>
		</tr>

		<tr>
			<td colspan="2">Hermed din rabatkode til brug på www.refurb.dk.</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:100px;">
				<?php if(Auth::user()->user_subscription == 'level2'){
					echo cmskey('refurb_email_code_pro',true); 
				}else{ 
						echo cmskey('refurb_email_code_premium',true); 
				}?>

			</td>
		</tr>

		<tr>
			<td colspan="2" >Klik her for at gå direkte til Refurbs side</td>
		</tr>
		<tr>
			<td colspan="2"><a style="background-color: #b8d7eb; padding: 10px 15px; border-radius: 5px; color: #B4C341; font-size: 16px; text-decoration: none;" href="www.refurb.dk" target="_blank">Køb IT hos Refurb med rabat</a>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br />God fornøjelse.</td> 
		</tr>
		<tr>
			<td colspan="2"><br /><br /><b>IVN</b></td> 
		</tr>
	</table>
</body>