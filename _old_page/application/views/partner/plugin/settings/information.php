<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#property").initDynamicField({
		p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="width:200px; min-width: 200px;"><input type="text" name="property_name[]" placeholder="Bezeichnung" /></td><td style="min-width: 230px; padding: 0 10px;"><input type="text" name="property_text[]" placeholder      ="Text" /></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
	});
	$("#website").initDynamicField({
		p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="width:150px; min-width: 150px; padding-right: 10px;"><div class="select-box"><select name="website_type[]"><?php foreach($this->General_Model->get_website_type()->result() as $row){ echo "<option value=\"$row->type_id\">$row->type_name</option>";} ?></select></div></td><td style="width:200px; min-width: 200px;"><input type="text" name="website_name[]" placeholder="Bezeichnung" /></td><td style="min-width: 230px; padding: 0 10px;"><input type="text" name="website_url[]" placeholder="Link" /></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
	});
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Allgemeine Informationen</h4>
	</div>
</div>
<form methode="post" data-url="/ajax/account/update_account/" data-redirect="/" data-type="normal">
<div class="column-2">
	<div class="column-content">
		<label>Hauptsitz</label>
		<div class="select-box">
			<select name="location">
				<option value="0">Standort auswählen...</option>
				<?php foreach ($this->Location_Model->get_location($object_account->company_id, "all")->result() as $row) { ?>
				<option value="<?=$row->location_id ?>"<?=($row->location_id != $object_account->location_id ? '' : ' selected="selected"' )?>><?=$row->location_name ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<label>Hauptkontaktperson</label>
		<div class="select-box">
			<select name="contact">
				<option value="0">Kontaktperson auswählen...</option>
				<?php foreach ($this->Contact_Model->get_contact($object_account->company_id, "all")->result() as $row) { ?>
				<option value="<?=$row->contact_id ?>"<?=($row->contact_id != $object_account->contact_id ? '' : ' selected="selected"' )?>><?=$row->contact_firstname ?> <?=$row->contact_lastname ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<label for="partner_description">Beschreibung</label>
		<textarea name="description" id="partner_description" style="height:200px; max-height:200px;"><?=$object_account->company_description; ?></textarea>
	</div>
</div>
<div class="column-1">
	<div class="column-content" style="padding-top:0; padding-bottom:0; margin-top:0; margin-bottom:0;">
		<label>Branche</label>
	</div>
</div>
<?php foreach ($this->General_Model->get_branche()->result() as $row) { ?>
<div class="column-3">
	<div class="column-content">
		<input type="checkbox" name="branche[]" value="<?=$row->branche_id ?>" id="branche_<?=$row->branche_id ?>"<?=($this->Account_Model->get_branche($object_account->company_id, $row->branche_id)->num_rows() == 0 ? '' : ' checked="checked"')?>> <label for="branche_<?=$row->branche_id ?>" style="font-weight:300;"><?=$row->branche_name ?></label>
	</div>
</div>
<?php } ?>
<div class="column-1">
	<div class="column-content" style="padding-top:0; padding-bottom:0; margin-top:0; margin-bottom:0;">
		<label>Sonstiges</label>
		<div class="dynamic-fields" id="property">
			<div class="dynamic-content">
				<?php foreach ($this->Account_Model->get_property($object_account->company_id)->result() as $row) { ?>
				<div class="responsive-table">
					<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
						<tbody>
							<tr>
								<td style="width:200px; min-width: 200px;"><input type="text" name="property_name[]" value="<?=$row->property_name ?>" placeholder="Bezeichnung" /></td>
								<td style="min-width: 230px; padding: 0 10px;"><input type="text" name="property_text[]" value="<?=$row->property_text ?>" placeholder="Text" /></td>
								<td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td>
							</tr>
						<tbody>
					</table>
				</div>
				<?php } ?>
			</div>
			<div class="dynamic-footer">
				<span class="link">Feld hinzufügen</span>
			</div>
		</div>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<h4>Online Auftritt</h4>
		<div class="dynamic-fields" id="website">
			<div class="dynamic-content">
				<?php foreach ($this->Account_Model->get_link($object_account->company_id, "ALL")->result() as $row) { ?>
				<div class="responsive-table">
					<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
						<tbody>
							<tr>
								<td style="width:150px; min-width: 150px; padding-right:10px;">
									<div class="select-box">
										<select name="website_type[]">
											<?php foreach($this->General_Model->get_website_type()->result() as $key){ echo '<option value="'.$key->type_id.'"'.($row->type_id != $key->type_id ? '' : ' selected="selected"').'>'.$key->type_name.'</option>';} ?>
										</select>
									</div>
								</td>
								<td style="width:200px; min-width: 200px;"><input type="text" name="website_name[]" placeholder="Bezeichnung" value="<?=$row->website_name;?>" /></td>
								<td style="min-width: 230px; padding: 0 10px;"><input type="text" name="website_url[]" value="<?=$row->website_url;?>" placeholder="Link" /></td>
								<td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td>
							</tr>
						<tbody>
					</table>
				</div>
				<?php } ?>
			</div>
			<div class="dynamic-footer">
				<span class="link">Feld hinzufügen</span>
			</div>
		</div>
		<hr />
		<button class="submit">Speichern</button>
	</div>
</div>
</form>
