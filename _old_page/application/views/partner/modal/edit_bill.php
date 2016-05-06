<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#list").initDynamicField({
		p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="min-width: 200px;"><input type="text" name="item_text[]" /></td><td style="width: 130px; min-width: 130px; padding: 0 10px;"><input type="text" name="item_price[]" style="text-align: right;" /></td><td><strong>&euro;</strong></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
	});
});
	
</script>
<form methode="post" data-url="/ajax/bill/update_bill/" data-type="normal" data-redirect="/">
	<input type="hidden" name="year" value="<?=$object_bill->bill_year; ?>"> 
	<input type="hidden" name="id" value="<?=$object_bill->bill_id; ?>"> 
	<div class="column-2">
		<div class="column-content">
			<label>Partner</label>
			<div class="select-box">
				<select name="partner">
					<option value="">Partner auswählen...</option>
					<?php
					foreach ($this->Partner_Model->get_partner("all")->result() as $row) {
					echo '<option value="'.$row->company_id.'"'.($row->company_id != $object_bill->company_id ? '' : ' selected="selected"').'>'.$row->company_name.'</option>';
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
					echo '<option value="'.$row->status_id.'"'.($row->status_id != $object_bill->status_id ? '' : ' selected="selected"').'>'.$row->status_name.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<label for="bill_address">Adresse</label>
			<input type="text" name="address" id="bill_address" value="<?=$object_bill->bill_address; ?>">
			<table style="width: 100%; border-spacing:0; border-collapse: collpase;">
				<tr>
					<td style="width: 29%; padding-right: 1%;">
						<label for="bill_pc">PLZ</label>
						<input type="text" name="pc" id="bill_pc" value="<?=$object_bill->bill_pc; ?>">
					</td>
					<td style="width: 69%; padding-left: 1%;">
						<label for="bill_city">Ort</label>
						<input type="text" name="city" id="bill_city" value="<?=$object_bill->bill_city; ?>">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="column-1">
		<div class="column-content">
			<label>Liste</label>
			<div class="dynamic-fields" id="list">
				<div class="dynamic-content">
					<?php
					foreach ($this->Bill_Model->get_item($object_bill->bill_year, $object_bill->bill_id)->result() as $row) {
					echo '<div class="responsive-table">
							<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
								<tbody>
									<tr>
										<td style="min-width: 200px;"><input type="text" name="item_text[]" value="'.$row->item_text.'" /></td>
										<td style="width: 130px; min-width: 130px; padding: 0 10px;"><input type="text" name="item_price[]" value="'.$row->item_price.'" style="text-align: right;" /></td>
										<td><strong>&euro;</strong></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td>
									</tr>
								<tbody>
							</table>
						  </div>';
					}
					?>
				</div>
				<div class="dynamic-footer">
					<span class="link">Feld hinzufügen</span>
				</div>
			</div>
			<hr color="#CCCCCC" style="margin: 10px 0;" />
			<button class="submit">Anlegen</button>
		</div>
	</div>
</form>