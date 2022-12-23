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
			<td>Virksomhed:</td>
			<td>{{!empty($name) ? $name:''}}</td>
		</tr>

		<tr>
			<td>Ejer:</td>
			<td>{{!empty($user_name) ? $user_name:''}}</td>
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
			<td>Formål:</td>
			<td>{{!empty($others) ? $others:''}}</td>
		</tr>		
	</table>
</body>