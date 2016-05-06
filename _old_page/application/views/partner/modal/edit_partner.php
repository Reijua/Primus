<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
});
</script>
<form methode="post" data-url="/ajax/partner/update_partner/" data-type="normal" data-redirect="/">
	<input type="hidden" name="id" value="<?=$object_partner->company_id; ?>">
	<div class="column-2">
		<div class="column-content">
			<label for="partner_name">Name</label>
			<input type="text" name="name" id="partner_name" value="<?=$object_partner->company_name; ?>" />
			<label>Paket</label>
			<div class="select-box">
				<select name="package">
					<option value="0">Paket auswählen...</option>
					<?php
					foreach ($this->Partner_Model->get_group()->result() as $row) {
					echo '<option value="'.$row->group_id.'"'.($object_partner->group_id != $row->group_id ? '' : ' selected="selected"').'>'.$row->group_name.'</option>';
					}
					?>
				</select>
			</div>
			<label for="partner_email">E-Mail-Adresse</label>
			<input type="email" name="email" id="partner_email" value="<?=$object_partner->company_email; ?>" />
			<label>Kontaktperson</label>
			<div class="select-box">
				<select name="supporter">
					<option value="0">Kontaktperson auswählen...</option>
					<?php
					foreach ($this->Account_Model->get_account("filter:group", "Management")->result() as $row) {
					echo '<option value="'.$row->member_id.'"'.($object_partner->supporter_id != $row->member_id ? '' : ' selected="selected"').'>'.($row->member_title != "" ? $row->member_title." " : "").''.$row->member_firstname.' '.$row->member_lastname.'</option>';
					}
					?>
				</select>
			</div>

		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<label for="partner_comment">Kommentar</label>
			<textarea name="comment" id="partner_comment" style="height:148px; max-height: 148px;"><?=$object_partner->company_comment ?></textarea>
			<hr color="#CCCCCC" style="margin: 3px 0 8px 0; padding:0;" />
			<button class="submit">Anlegen</button>
		</div>
	</div>
</form>