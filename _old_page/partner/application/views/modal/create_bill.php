<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#list").initDynamicField({
		p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="min-width: 200px;"><input type="text" name="item_text[]" /></td><td style="width: 130px; min-width: 130px; padding: 0 10px;"><input type="text" name="item_price[]" style="text-align: right;" /></td><td><strong>&euro;</strong></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
	});
});
	
</script>
<form methode="post" data-url="/ajax/bill/create_bill/" data-type="normal" data-redirect="/">
	<div class="column-2">
		<div class="column-content">
			<label>Partner</label>
			<div class="select-box">
				<select name="partner">
					<option value="">Partner auswählen...</option>
					<?php
					foreach ($this->Partner_Model->get_partner("all")->result() as $row) {
					echo '<option value="'.$row->company_id.'">'.$row->company_name.'</option>';
					}
					?>
				</select>
			</div>
			<label>Status</label>
			<div class="select-box">
				<select name="status">
					<option value="0">Status auswählen...</option>
					<?php
					foreach ($this->Bill_Model->get_status()->result() as $row) {
					echo '<option value="'.$row->status_id.'">'.$row->status_name.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<label for="bill_address">Adresse</label>
			<input type="text" name="address" id="bill_address">
			<table style="width: 100%; border-spacing:0; border-collapse: collpase;">
				<tr>
					<td style="width: 29%; padding-right: 1%;">
						<label for="bill_pc">PLZ</label>
						<input type="text" name="pc" id="bill_pc">
					</td>
					<td style="width: 69%; padding-left: 1%;">
						<label for="bill_city">Ort</label>
						<input type="text" name="city" id="bill_city">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="column-1">
		<div class="column-content">
			<label>Liste</label>
			<div class="dynamic-fields" id="list">
				<div class="dynamic-content"></div>
				<div class="dynamic-footer">
					<span class="link">Feld hinzufügen</span>
				</div>
			</div>
			<hr color="#CCCCCC" style="margin: 10px 0;" />
			<button class="submit">Anlegen</button>
		</div>
	</div>
</form>