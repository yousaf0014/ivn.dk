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
			<td colspan="2">Hej.</td>
		</tr>

		<tr>
			<td colspan="2">{{$first_name.' '.$last_name}} har opsagt sit abonnement med IVN, og da vedkommende har valgt at tage del jeres tilbud på siden, gør vi hermed opmærksom på, at der skal tages højde for evt. samarbejdsaftaler med brugeren på følgende e-mail:{{$email}}</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-left:100px;">Hvis der er spørgsmål, kontakt da Tine Radoor på tine@ivn.dk.</td>
		</tr>
		<tr>
			<td colspan="2"><br />God dag</td> 
		</tr>
		<tr>
			<td colspan="2"><br /><br /><b>IVN</b></td> 
		</tr>
	</table>
</body>