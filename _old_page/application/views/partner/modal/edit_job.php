<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).tabs();
		$("#task").initDynamicField({
			p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="min-width: 200px;"><input type="text" name="task[]"/></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
		});
		$("#qualification").initDynamicField({
			p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="min-width: 200px;"><input type="text" name="qualification[]"/></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
		});
		$("#benefit").initDynamicField({
			p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td style="min-width: 200px;"><input type="text" name="benefit[]"/></td><td class="text-right" style="width:90px; min-width: 90px;"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
		});
	});
</script>
<form methode="post" data-url="/ajax/job/update_job/" data-type="normal" data-redirect="/">
	<input type="hidden" name="id" value="<?=$object_job->job_id ?>">
	<div class="column-1">
		<div class="column-content">
			<label for="job_name">Titel</label>
			<input type="text" name="name" id="job_name" value="<?=$object_job->job_title ?>" />
		</div>
	</div>
	<div class="column-2">
		<div class="column-content" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
			<label>Standort</label>
			<div class="select-box">
				<select name="location">
					<option value="0">Standort auswählen...</option>
					<?php foreach ($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
					<option value="<?=$row->location_id ?>"<?=($object_job->location_id != $row->location_id ? '' : ' selected="selected"') ?>><?=$row->location_name?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="column-2">
		<div class="column-content" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
			<label>Kontaktperson</label>
			<div class="select-box">
				<select name="contact">
					<option value="0">Kontaktperson auswählen...</option>
					<?php foreach ($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
					<option value="<?=$row->contact_id ?>"<?=($object_job->contact_id != $row->contact_id ? '' : ' selected="selected"') ?>><?=($row->contact_title == "" ? '' : $row->contact_title.' ')?><?=$row->contact_firstname?> <?=$row->contact_lastname?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="column-1" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
		<div class="column-content">
			<label for="job_preamble">Vorwort</label>
			<textarea id="job_preamble" name="preamble" style="height:150px; max-height: 150px;"><?=$object_job->job_preamble ?></textarea>
		</div>
	</div>
	<div class="column-2" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
		<div class="column-content">
			<label>Aufgaben</label>
			<div class="dynamic-fields" id="task">
				<div class="dynamic-content">
					<?php foreach ($this->Job_Model->get_section_item($object_job->job_id, "Aufgaben")->result() as $row) { ?>
					<div class="responsive-table">
						<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
							<tbody>
								<tr>
									<td style="min-width: 200px;"><input type="text" name="task[]" value="<?=$row->item_text ?>"/></td>
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
	<div class="column-2" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
		<div class="column-content">
			<label>Anforderungen</label>
			<div class="dynamic-fields" id="qualification">
				<div class="dynamic-content">
					<?php foreach ($this->Job_Model->get_section_item($object_job->job_id, "Qualifikationen")->result() as $row) { ?>
					<div class="responsive-table">
						<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
							<tbody>
								<tr>
									<td style="min-width: 200px;"><input type="text" name="qualification[]" value="<?=$row->item_text ?>"/></td>
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
	<div class="column-1" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
		<div class="column-content">
			<label>Was wir bieten</label>
			<div class="dynamic-fields" id="benefit">
				<div class="dynamic-content">
					<?php foreach ($this->Job_Model->get_section_item($object_job->job_id, "Angebot")->result() as $row) { ?>
					<div class="responsive-table">
						<table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;">
							<tbody>
								<tr>
									<td style="min-width: 200px;"><input type="text" name="benefit[]" value="<?=$row->item_text ?>"/></td>
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
	<div class="column-1" style="margin-top:0;padding-top:0;">
		<div class="column-content">
			<label for="job_summary">Schlusswort</label>
			<textarea id="job_summary" name="summary" style="height:150px; max-height: 150px;"><?=$object_job->job_summary ?></textarea>
			<hr />
			<button class="submit">Hinzufügen</button>
		</div>
	</div>
</form>