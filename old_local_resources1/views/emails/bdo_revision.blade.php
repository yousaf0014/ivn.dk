<body>
	<table cellpadding="10" cellspacing="0">
		<tr>
			<td>{{date('m/d/Y')}}</td>
			<td>
				<div style="float:right"><img src="{{ asset('images/img-ivn-contact-us.jpg') }}"></div>
				<div style="clear:both"></div>
			</td>
		</tr>
		<?php if(!empty($red1)){?>
			<tr><td>FÅ ET GRATIS MØDE<td><td>Yes</td></tr>
		<?php } ?>
		<?php if(!empty($red2)){?>
			<tr><td>BDO Online<td><td>Yes</td></tr>
		<?php } ?>
		<?php if(!empty($red3)){?>
			<tr><td>Opstart BDO Online<td>Yes<td></td></tr>
		<?php } ?>
		<tr>
			<td>Virksomhedens Navn:</td>
			<td>{{!empty($name) ? $name:''}}</td>
		</tr>

		<tr>
			<td>CVR-Nummer:</td>
			<td>{{!empty($cvr) ? $cvr:''}}</td>
		</tr>

		<tr>
			<td>Ejernes navne:</td>
			<td>{{!empty($ejernes) ? $ejernes:''}}</td>
		</tr>

		<tr>
			<td>Telefonnummer:</td>
			<td>{{!empty($telephone) ? $telephone:''}}</td>
		</tr>

		<tr>
			<td>E-Mail</td>
			<td>{{!empty($email) ? $email:''}}</td>
		</tr>
	</table>
</body>