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
			<td>Virksomhedsnavn:</td>
			<td>{{!empty($Virksomhedsnavn) ? $Virksomhedsnavn:''}}</td>
		</tr>

		<tr>
			<td>cvr:</td>
			<td>{{!empty($cvr) ? $cvr:''}}</td>
		</tr>

		<tr>
			<td>Email:</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>

		<tr>
			<td>Navn:</td>
			<td>{{!empty($name) ? $name:''}}</td>
		</tr>

		<tr>
			<td>Telefonnr:</td>
			<td>{{!empty($telephone) ? $telephone:''}}</td>
		</tr>
		<tr>
			<td>Information om dit forsikringsbehov:</td>
			<td>{{!empty($details) ? $details:''}}</td>
		</tr>
	</table>
</body>