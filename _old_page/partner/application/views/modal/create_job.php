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
<div class="tabs">
	<nav style="background-color: #FFFFFF;">
		<ul style="margin-left: 20px !important;">
			<li data-tab="tab-1">Formular</li>
			<li data-tab="tab-2">PDF</li>
		</ul>
	</nav>
	<div class="content">
		<div id="tab-1" class="tab-item" style="padding:0 !important;">
			<form methode="post" data-url="/ajax/job/create_job/" data-type="normal" data-redirect="/">
				<div class="column-1">
					<div class="column-content">
						<label for="job_name">Titel</label>
						<input type="text" name="name" id="job_name" />
					</div>
				</div>
				<div class="column-2">
					<div class="column-content" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
						<label>Standort</label>
						<div class="select-box">
							<select name="location">
								<option value="0">Standort auswählen...</option>
								<?php foreach ($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
								<option value="<?=$row->location_id ?>"><?=$row->location_name?></option>
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
								<option value="<?=$row->contact_id ?>"><?=($row->contact_title == "" ? '' : $row->contact_title.' ')?><?=$row->contact_firstname?> <?=$row->contact_lastname?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="column-1" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
					<div class="column-content">
						<label for="job_preamble">Vorwort</label>
						<textarea id="job_preamble" name="preamble" style="height:150px; max-height: 150px;"></textarea>
					</div>
				</div>
				<div class="column-2" style="margin-top:0; margin-bottom:0;padding-top:0; padding-bottom:0;">
					<div class="column-content">
						<label>Aufgaben</label>
						<div class="dynamic-fields" id="task">
							<div class="dynamic-content">
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
						<textarea id="job_summary" name="summary" style="height:150px; max-height: 150px;"></textarea>
						<hr />
						<button class="submit">Hinzufügen</button>
					</div>
				</div>
			</form>
		</div>
		<div id="tab-2">
			<div class="column-2">
				<div class="column-content">
					<strong>Informationen</strong><br />
					<br />
					Um Ihnen die Erstellung von Jobangeboten zu vereinfachen, haben sie die Möglichkeit, Stellenangebote im PDF-Format hochzuladen. Falls es irgendwelche Unklarheiten gibt, wird sich Ihr Ansprechpartner umgehend bei Ihnen melden. Ist alles vollständig, schalten wir das Jobangebot für die Mitglieder auf der Plattform frei.
				</div>
			</div>
			<div class="column-2">
				<div class="column-content">
					<form methode="post" data-url="/ajax/job/send_job/" data-type="normal" data-redirect="/">
						<label>Standort</label>
						<div class="select-box">
							<select name="location">
								<option value="0">Standort auswählen...</option>
								<?php foreach ($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
								<option value="<?=$row->location_id ?>"><?=$row->location_name?></option>
								<?php } ?>
							</select>
						</div>
						<label>Kontaktperson</label>
						<div class="select-box">
							<select name="contact">
								<option value="0">Kontaktperson auswählen...</option>
								<?php foreach ($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
								<option value="<?=$row->contact_id ?>"><?=($row->contact_title == "" ? '' : $row->contact_title.' ')?><?=$row->contact_firstname?> <?=$row->contact_lastname?></option>
								<?php } ?>
							</select>
						</div>
						<label>Datei</label>
						<div class="file-selector">
							<input type="file" id="file" name="file" />
							Datei auswählen...
						</div>
						<hr />
						<button class="submit">Senden</button>
					</form>				
				</div>
			</div>
		</div>
	</div>
</div>

<div class="column-2">
	<div class="column-content">

	</div>
</div>
<div class="column-2">
	<div class="column-content">
		
	</div>
</div>