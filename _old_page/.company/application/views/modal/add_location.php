<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
});
</script>
<div class="column-2">
	<div class="column-content">
		<strong>Information</strong><br />
		So einfach geht es...
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<form methode="post" form-url="/ajax/account/add_location/" form-type="normal" form-redirect="/">
			<label for="location_name">Bezeichnung</label>
			<input type="text" name="name" id="location_name">
			<label for="location_address">Adresse</label>
			<input type="text" name="address" id="location_address">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="29%" style="padding-right:1%;">
						<label for="location_pc">PLZ</label>
						<input type="text" name="pc" id="location_pc">
					</td>
					<td width="79%" style="padding-left:1%;">
						<label for="location_city">Ort</label>
						<input type="text" name="city" id="location_city">
					</td>
				</tr>
			</table>
			<label>Land</label>
			<div class="select-box">
				<select name="country">
					<option value="0">Bitte Land auswählen...</option>
					<?php
					foreach ($array_country as $row) {
						echo '<option value="'.$row->country_id.'">'.$this->lang->line("country_".str_replace(' ', '_', $row->country_name)).'</option>';
					}
					?>
				</select>
			</div>
			<label for="location_email">E-Mail-Adresse</label>
			<input type="text" name="email" id="location_email">
			<label for="location_phone">Telefon</label>
			<input type="text" name="phone" id="location_phone">
			<label for="location_fax">Fax</label>
			<input type="text" name="fax" id="location_fax">
			<label for="location_website">Website</label>
			<input type="text" name="website" id="location_website">
			<button id="submit">Hinzufügen</button>
		</form>
	</div>
</div>