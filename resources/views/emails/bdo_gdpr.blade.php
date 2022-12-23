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
			<td><b>{{$user['first_name'].' '.$user['last_name']}} </b></td>
			<td> vil gerne have hjælp til GDPR</td>
		</tr>
		<tr>
			<td><b>Email:</b></td>
			<td>{{$user['email']}}</td>
		</tr>
		<tr>
			<td colspan="2"><br />God fornøjelse.</td> 
		</tr>
		<tr>
			<td colspan="2"><br /><br /><b>IVN</b></td> 
		</tr>
	</table>
</body>