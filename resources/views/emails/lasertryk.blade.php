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
			<td colspan="2"><b>Få rabat når du køber tryksager</b></td>
		</tr>
		<tr>
			<td colspan="2">Hermed din rabatkode til brug på ivn.lasertryk.dk </td>
		</tr>
		

		<tr>
			<td colspan="2" style="padding-left:100px;">
				<?php if(Auth::user()->user_subscription == 'level2'){
					echo cmskey('lasertryk_email_code_pro',true); 
					}else{ 
						echo cmskey('lasertryk_emailcode_premium',true); 
					}?>
				</td>
		</tr>

		<tr>
			<td colspan="2" >Klik her for at gå direkte til Lasertryks side:</td>
		</tr>
		<tr>
			<td colspan="2"><a style="background-color: #b8d7eb; padding: 10px 15px; border-radius: 5px; color: #333; font-size: 16px; text-decoration: none;" href="ivn.lasertryk.dk" target="_blank">Køb tryksager med rabat</a>
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