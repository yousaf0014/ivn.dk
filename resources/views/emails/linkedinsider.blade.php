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
			<td>Hvilken dato vil du på kursus:</td>
			<td><?php echo !empty($kursus) ? $kursus:'';?></td>
		</tr>

		<tr>
			<td>Navn:</td>
			<td><?php echo !empty($navn) ? $navn:'';?></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><?php echo !empty($email) ? $email:'';?></td>
		</tr>
		<tr>
			<td colspan="2"><br /><br /><b>IVN</b></td> 
		</tr>
	</table>
</body>