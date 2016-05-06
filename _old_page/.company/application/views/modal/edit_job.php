<script type="text/javascript">


$(document).ready(function(){
	$(document).initFormSystem();
	$("#job_month_rate").change(function(){
		$(this).val(number_format($(this).val(),2,',','.'));
	});

	$("#job_profile").initDynamicFields({
		p_field : '<tr><td width="*"><input type="text" name="qualification[]" /></td><td width="80px" class="text-center"><span>Löschen</span></td></tr>'
	});
	$("#job_task").initDynamicFields({
		p_field : '<tr><td width="*"><input type="text" name="task[]" /></td><td width="80px" class="text-center"><span>Löschen</span></td></tr>'
	});
});
</script>
<div class="column-1" style="overflow:auto; height:100%;">
	<form methode="post" form-url="/ajax/account/update_job/" form-type="normal" form-redirect="/">
		<input type="hidden" name="id" value="<?php echo $object_job->job_id; ?>" />
		<div class="column-2">
			<div class="column-content" style="padding-bottom:0; margin-bottom:0;">
				<label for="job_title">Titel</label>
				<input type="text" name="title" id="job_title" value="<?php echo $object_job->job_title; ?>" />
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="padding-bottom:0; margin-bottom:0;">
				<label>Kategorie</label>
				<div class="select-box">
					<select name="category">
						<option value="0">Kategorie auswählen...</option>
						<?php
						foreach ($this->Job_Model->get_category()->result() as $row) {
							echo '<option value="'.$row->category_id.'" '.($object_job->category_id != $row->category_id?'':'selected="selected"').'>'.$row->category_name.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label>Beschäftigungsart</label>
				<div class="select-box">
					<select name="employee_mode">
						<option value="0">Beschäftigungsart auswählen...</option>
						<?php
						foreach ($this->Job_Model->get_mode()->result() as $row) {
							echo '<option value="'.$row->mode_id.'" '.($object_job->mode_id != $row->mode_id?'':'selected="selected"').'>'.$this->lang->line('mode_'.$row->mode_name).'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label for="job_month_rate">Gehalt laut Kollektiv</label>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="*">
							<input type="text" id="job_month_rate" name="month_rate" value="<?php echo number_format($object_job->job_month_rate, 2, ',', '.'); ?>" placeholder="2000,00">
						</td>
						<td width="110px">
							<div class="select-box">
								<select name="interval" style="padding-left:10px;">
								<?php
								foreach ($this->Job_Model->get_payment_interval()->result() as $row) {
									echo '<option value="'.$row->interval_id.'" '.($row->interval_id != $object_job->interval_id? '' : 'selected="selected"').'>'.$this->lang->line('interval_'.$row->interval_name).'</option>';
								}
								?>
								</select>
							</div>
						</td>
						<td width="110px">
							<div class="select-box">
								<select name="currency" style="padding-left:10px;">
								<?php
								foreach ($this->Job_Model->get_currency()->result() as $row) {
									echo '<option value="'.$row->currency_id.'" '.($object_job->currency_id != $row->currency_id?'':'selected="selected"').'>'.$row->currency_name.' ('.$row->currency_sign.')</option>';
								}
								?>
								</select>
							</div>
						</td>
					</tr>
				</table>
				
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label>Standort</label>
				<div class="select-box">
					<select name="location">
						<option value="0">Standort auswählen...</option>
						<?php
						foreach ($this->Account_Model->get_location($this->session->userdata("account_id"))->result() as $row) {
							echo '<option value="'.$row->location_id.'" '.($object_job->location_id != $row->location_id?'':'selected="selected"').'>'.$row->location_name.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label>Kontaktperson</label>
				<div class="select-box">
					<select name="contact">
						<option value="0">Kontaktperson auswählen...</option>
						<?php
						foreach ($this->Account_Model->get_contact($this->session->userdata("account_id"))->result() as $row) {
							echo '<option value="'.$row->contact_id.'" '.($object_job->contact_id != $row->contact_id?'':'selected="selected"').'>'.$row->contact_firstname.' '.$row->contact_lastname.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label for="job_preface">Firmenvorstellung</label>
				<textarea style="height:100px;" id="job_preface" name="preface"><?php echo $object_job->job_preface; ?></textarea>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label for="job_title">Aufgabenbereich</label>
				<div id="job_task" class="dynamic-field">
					<table width="100%" cellpadding="0" cellspacing="0">
					<?php 
					foreach ($this->Job_Model->get_section_item($object_job->job_id, "Task")->result() as $row) {
						echo '
						<tr>
							<td width="*">
								<input type="text" name="task[]" value="'.$row->item_name.'" />
							</td>
							<td width="80px" class="text-center">
								<span>Löschen</span>
							</td>
						</tr>
						';
					}
					?>						
					</table>
				</div>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin-top:0;padding-top:0;padding-bottom:0; margin-bottom:0;">
				<label>Qualifikationen</label>
				<div id="job_profile" class="dynamic-field">
					<table width="100%" cellpadding="0" cellspacing="0">
					<?php 
					foreach ($this->Job_Model->get_section_item($object_job->job_id, "Qualification")->result() as $row) {
						echo '
						<tr>
							<td width="*">
								<input type="text" name="qualification[]" value="'.$row->item_name.'" />
							</td>
							<td width="80px" class="text-center">
								<span>Löschen</span>
							</td>
						</tr>
						';
					}
					?>						
					</table>
				</div>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" style="margin-top:0;padding-top:0;">
				<label for="job_acknowledgment">Zusatzinformationen</label>
				<textarea style="height:100px;" name="acknowledgment" id="job_acknowledgment"><?php echo $object_job->job_acknowledgement; ?></textarea>
				<button id="submit">Bearbeiten</button>
			</div>
		</div>

		
	</form>
</div>