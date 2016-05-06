<div class="slider-wrapper">
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#signup_name, #signup_email, #signup_package, #bill_address, #bill_pc, #bill_city").initSammary({
		p_prefix : "out"
	});
});
</script>
<div id="content-wrapper">
	<div id="content-holder">
		<form methode="post" form-url="/ajax/account/signup/" form-type="normal">
		<div class="column-1">
			<div class="column-content text-center">
				<h1>Konto erstellen</h1>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="padding-top:5px;">
				<h4 style="margin:10px 0;">Konto</h4>
				<label for="signup_name">Firmenname</label>
				<input name="name" id="signup_name" type="text" />
				<label for="signup_email">E-Mail-Adresse</label>
				<input name="email" id="signup_email" type="email" />
				<label for="signup_password">Passwort</label>
				<input name="password" id="signup_password" type="password" />
				<label for="signup_password_confirm">Passwort bestätigen</label>
				<input name="password_confirm" id="signup_password_confirm" type="password" />
			</div>
		</div>
		<div class="column-1"></div>
		<div class="column-2">
			<div class="column-content">
				<h4 style="margin:15px 0;">Paketauswahl &amp; Rechnungsadresse</h4>
				<label for="signup_package">Paket</label>
				<div class="select-box">
					<select id="signup_package" name="package">
						<option value="0">Bitte ein Paket auswählen...</option>
						<?php 
						foreach ($array_package as $row) {
							echo '<option value="'.$row->package_id.'" '.($this->input->get_post('package')==$row->package_id?'selected="selected"':'').'>'.$this->lang->line("package_".strtolower($row->package_name)).'</option>';
						}
						?>						
					</select>
				</div>
				<label for="bill_address">Straße</label>
				<input type="text" name="address" id="bill_address">
				<div class="column" style="width:30%;">
				</div>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="29%" style="padding-right:1%;">
							<label for="bill_pc">PLZ</label>
							<input type="text" name="pc" id="bill_pc">
						</td>
						<td width="69%" style="padding-left:1%;">
							<label for="bill_city">Ort</label>
							<input type="text" name="city" id="bill_city">
						</td>
					</tr>
				</table>				
			</div>
		</div>
		<div class="column-1"></div>
		<div class="column-2">
			<div class="column-content">
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<h4 style="margin:15px 0;">Zusammenfassung</h4>
				<strong>Rechnungsadresse:</strong><br />
				<br />
				<div class="out_signup_name"></div>
				<div class="out_bill_address"></div>
				<div class="out_bill_pc" style="float:left"></div> <div class="out_bill_city" style="float:left"></div> <br />
				<br />
				<strong>Versand:</strong> per E-Mail an <span class="out_signup_email">-</span><br />
				<strong>Paket:</strong> <span class="out_signup_package">-</span><br />
				
				<div class="column-1" style="margin:10px 0; border-top:1px solid #CCCCCC;"></div>
				Indem Sie auf "Konto erstellen" klicken, erklären Sie sich mit unseren <a href="http://primus-romulus.net/site/legal/tos/">Nutzungsbedingungen</a> einverstanden und bestätigen, dass Sie unserer <a href="http://primus-romulus.net/site/legal/gtc/">Datenschutzerklärung</a> zustimmen sowie unseren <a href="http://primus-romulus.net/site/legal/toc/">Cookie-Richtlinien</a>. Des Weiteren erklären Sie, dass die Rechnungsadresse stimmt und Sie die Rechnung innerhalb der nächsten 14 Tage bezahlen werden.
				<div class="column-1" style="margin:10px 0; border-top:1px solid #CCCCCC;"></div>
				<button id="submit">Konto erstellen</button>
			</div>
		</div>
		</form>
	</div>
</div>
<div class="divider" id="white-dark-grey"></div>