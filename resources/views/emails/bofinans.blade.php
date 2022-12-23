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
			<td>Navn:</td>
			<td>{{!empty($name) ? $name:''}}</td>
		</tr>

		<tr>
			<td>Firmanavn:</td>
			<td>{{!empty($first_name) ? $first_name:''}}</td>
		</tr>

		<tr>
			<td>E-mail:</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>

		<tr>
			<td>Telefonnr.:</td>
			<td>{{!empty($telephone) ? $telephone:''}}</td>
		</tr>

		<tr>
			<td>Postnr.:</td>
			<td>{{!empty($post_code) ? $post_code:''}}</td>
		</tr>

		<tr>
			<td>Evt. Adresse:</td>
			<td>{{!empty($address) ? $address:''}}</td>
		</tr>
		<tr>
			<td>Kommentarer:</td>
			<td>{{!empty($details) ? $details:''}}</td>
		</tr>
	</table>
</body>