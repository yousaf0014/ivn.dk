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
			<td>CVR:</td>
			<td>{{!empty($cvr) ? $cvr:''}}</td>
		</tr>

		<tr>
			<td>Dit navn:</td>
			<td>{{!empty($first_name) ? $first_name:''}}</td>
		</tr>

		<tr>
			<td>Mobiltelefon:</td>
			<td>{{!empty($telephone) ? $telephone:''}}</td>
		</tr>

		<tr>
			<td>E-mail:</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>

		<tr>
			<td>Om sagen:</td>
			<td>{{!empty($fax) ? $fax:''}}</td>
		</tr>

		<tr>
			<td>Beskriv sagen så detaljeret so muligt::</td>
			<td>{{!empty($details) ? $details:''}}</td>
		</tr>		
	</table>
</body>