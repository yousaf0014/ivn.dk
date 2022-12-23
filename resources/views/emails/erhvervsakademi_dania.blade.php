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
			<td>E-mail:</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>

		<tr>
			<td>Telefonnummer:</td>
			<td>{{!empty($telephone) ? $telephone:''}}</td>
		</tr>
		<tr>
			<td></td>
			<td>{{!empty($option1) ? $option1:''}}</td>
		</tr>
		<tr>
			<td></td>
			<td>{{!empty($option2) ? $option2:''}}</td>
		</tr>
		<tr>
			<td></td>
			<td>{{!empty($option3) ? $option3:''}}</td>
		</tr>
	</table>
</body>