<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
});
</script>
<div class="column-1" style="overflow:auto; height:100%;">
	<div class="column-2">
		<div class="column-content">
			<strong>Information</strong><br />
			So einfach geht es...
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<form methode="post" form-url="/ajax/account/update_location/" form-type="normal" form-redirect="/">
				<input type="hidden" name="id" value="<?php echo $object_location->location_id; ?>">
				<label for="location_name">Bezeichnung</label>
				<input type="text" name="name" id="location_name" value="<?php echo $object_location->location_name; ?>">
				<label for="location_address">Adresse</label>
				<input type="text" name="address" id="location_address" value="<?php echo $object_location->location_address; ?>">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="29%" style="padding-right:1%;">
							<label for="location_pc">PLZ</label>
							<input type="text" name="pc" id="location_pc" value="<?php echo $object_location->location_pc; ?>">
						</td>
						<td width="79%" style="padding-left:1%;">
							<label for="location_city">Ort</label>
							<input type="text" name="city" id="location_city" value="<?php echo $object_location->location_city; ?>">
						</td>
					</tr>
				</table>
				<label>Land</label>
				<div class="select-box">
					<select name="country">
						<option value="0">Bitte Land auswählen...</option>
						<?php
						foreach ($array_country as $row) {
							echo '<option value="'.$row->country_id.'" '.($row->country_id != $object_location->country_id ? '' : 'selected="selected"').'>'.$this->lang->line("country_".str_replace(' ', '_', $row->country_name)).'</option>';
						}
						?>
					</select>
				</div>
				<label for="location_email">E-Mail-Adresse</label>
				<input type="text" name="email" id="location_email" value="<?php echo $object_location->location_email; ?>">
				<label for="location_phone">Telefon</label>
				<input type="text" name="phone" id="location_phone" value="<?php echo $object_location->location_phone; ?>">
				<label for="location_fax">Fax</label>
				<input type="text" name="fax" id="location_fax" value="<?php echo $object_location->location_fax; ?>">
				<label for="location_website">Website</label>
				<input type="text" name="website" id="location_website" value="<?php echo $object_location->location_website; ?>">
				<button id="submit">Bearbeiten</button>
			</form>
		</div>
	</div>
</div>