<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
});
</script>
<div class="column-1" style="height:100%; overflow:auto;">
	<div class="column-1">
		<div class="column-content">
			<h4>Allgemeine Daten</h4>
		</div>
	</div>
	<form methode="post" form-url="/ajax/account/update_profile/" form-type="normal" form-redirect="/">
		<div class="column-2">
			<div class="column-content" style="margin-bottom:0px;padding-bottom:0px;">
				<label>Branche</label>
				<div class="select-box">
					<select name="branche">
						<option>Branche auswählen...</option>
						<?php
						foreach ($this->Company_Model->get_branche()->result() as $row) {
						echo '<option value="'.$row->branche_id.'"'.($row->branche_id!=$object_account->branche_id?'':' selected="selected"').'>'.$row->branche_name.'</option>';
						}
						?>
					</select>
				</div>
				<label>Hauptkontakt</label>
				<div class="select-box">
					<select name="contact">
						<option>Ansprechperson auswählen...</option>
						<?php
						foreach ($this->Account_Model->get_contact(intval($this->session->userdata('account_id')))->result() as $row) {
						echo '<option value="'.$row->contact_id.'"'.($row->contact_id!=$object_account->contact_id?'':' selected="selected"').'>'.($row->contact_title==""?'':$row->contact_title.' ').''.$row->contact_firstname.' '.$row->contact_lastname.'</option>';
						}
						?>
					</select>
				</div>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="49%" style="padding-right:1%;" valign="bottom">
							<label for="amount_of_employee">Mitarbeiter</label>
							<input type="text" name="amount_of_employee" id="amount_of_employee" value="<?php echo $object_account->amount_of_employee; ?>">
						</td>
						<td width="49%" style="padding-left:1%;" valign="bottom">
							<label for="employee_per_year">Gesuchte Mitarbeiter/Jahr</label>
							<input type="text" name="employee_per_year" id="employee_per_year" value="<?php echo $object_account->employee_per_year; ?>">
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-bottom:0px;padding-bottom:0px;">
				<label>Gründungsjahr</label>
				<input type="text" name="release_year" maxlength="4" placeholder="Jahr" value="<?php echo $object_account->company_release_year; ?>">			
				<label>Hauptsitz</label>
				<div class="select-box">
					<select name="location">
						<option>Hauptsitz auswählen...</option>
						<?php
						foreach ($this->Account_Model->get_location(intval($this->session->userdata('account_id')))->result() as $row) {
						echo '<option value="'.$row->location_id.'"'.($row->location_id!=$object_account->location_id?'':' selected="selected"').'>'.$row->location_name.'</option>';
						}
						?>
					</select>
				</div>
				<label>Häufig gesuchte Mitarbeiter</label>
				<input type="text" name="most_common_employee" value="<?php echo $object_account->most_common_employee; ?>">
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" style="margin-top:0px;padding-top:0px;">
				<label>Beschreibung</label>
				<textarea style="height:150px;" name="description"><?php echo $object_account->company_description; ?></textarea>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content">
				<h4>Social Network</h4>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label for="network_facebook">Facebook</label>
				<input type="text" name="facebook" id="network_facebook" value="<?php echo $object_account->company_facebook; ?>">
				<label for="network_linkedin">LinkedIn</label>
				<input type="text" name="linkedin" id="network_linkedin" value="<?php echo $object_account->company_linkedin; ?>">
				<label for="network_xing">Xing</label>
				<input type="text" name="xing" id="network_xing" value="<?php echo $object_account->company_xing; ?>">
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label for="network_google_plus">Google +</label>
				<input type="text" name="google_plus" id="network_google_plus" value="<?php echo $object_account->company_google_plus; ?>">
				<label for="network_twitter">Twitter</label>
				<input type="text" name="twitter" id="network_twitter" value="<?php echo $object_account->company_twitter; ?>">
				<label for="network_youtube">YouTube</label>
				<input type="text" name="youtube" id="network_youtube" value="<?php echo $object_account->company_youtube; ?>">
			</div>
		</div>
		<div class="column-1">
			<div class="column-content">
				<button id="submit">Speichern</button>
			</div>
		</div>
	</form>
</div>