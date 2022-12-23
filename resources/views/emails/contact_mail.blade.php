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
			<td>Fornavn:</td>
			<td>{{$first_name}}</td>
		</tr>
		<tr>
			<td>Efternavn:</td>
			<td>{{$last_name}}</td>
		</tr>
		
		<tr>
			<td>E-mail:</td>
			<td>{{$email}}</td>
		</tr>
		
		<tr>
			<td>Besked:</td>
			<td>
				<div style="margin-top:50px;">
					{{$details}}
				</div>
			</td>
			<td>
				&nbsp;				
			</td>
		</tr>
	</table>
</body>