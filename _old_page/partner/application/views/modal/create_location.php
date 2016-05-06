<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
});	
</script>
<form methode="post" data-url="/ajax/location/create_location/" data-type="normal" data-redirect="/">
	<div class="column-2">
		<div class="column-content">
			<label for="location_name">Bezeichnung</label>
			<input type="text" name="name" id="location_name" />
			<label for="location_address">Adresse</label>
			<input type="text" name="address" id="location_address" />
			<table style="width:100%; border-spacing:0; border-collapse:0;">
				<tr>
					<td style="width: 29%; padding-right:1%;">
						<label for="location_pc">PLZ</label>
						<input type="text" name="pc" id="location_pc">
					</td>
					<td style="width: 69%; padding-left:1%;">
						<label for="location_city">Ort</label>
						<input type="text" name="city" id="location_city">
					</td>
				</tr>
			</table>
			<label>Land</label>
			<div class="select-box">
				<select name="country">
					<option value="0">Land auswählen ...</option>
					<?php foreach ($this->General_Model->get_country()->result() as $row) { ?>
					<option value="<?=$row->country_id;?>"><?=$row->country_name;?></option>
					<?php } ?>
				</select>
			</div>
			<button class="submit">Hinzufügen</button>
		</div>
	</div>
</form>