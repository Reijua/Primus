<div class="container partner-settings">
		
	<form action="/partner/settings" method="post" enctype="multipart/form-data">
		<input type="hidden" name="form" value="company-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Unternehmenseinstellungen
			</div>
			<div class="panel-body">
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Absolventen können diese Informationen (außer E-Mail-Adresse und Vertragspaket) sehen.
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-Mail</label>
									<p class="form-control-static" id="email"><?= $user_email ?></p>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="packet">Vertragspaket</label>
									<p class="form-control-static" id="packet"><?= $companypacket_description ?></p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Firmenname, Bezeichnung" value="<?= empty(form_error('name')) ? $company_name : set_value('name') ?>">
							<?= form_error('name') ?>
						</div>
						<div class="form-group">
							<label for="description">Beschreibung</label>
							<textarea class="form-control" rows="8" id="description" name="description" placeholder="Text"><?= empty(form_error('description')) ? html_breaks($company_description) : set_value('description') ?></textarea>
							<?= form_error('description'); ?>
						</div>
						<div class="form-group">
							<label for="location">Hauptstandort</label>
							<select class="form-control" id="location" name="location">
								<option value="-">Auswählen ...</option>
								<?php foreach ($this->Location->get_location('filter:company', $this->session->partner['company_id'])->result() as $i => $row): ?>
								<option value="<?= $row->location_id ?>" <?= (empty(form_error('location')) ? ($company_main_location == $row->location_id ? 'selected' : '') : set_select('location', $row->location_id)) ?>><?= $row->location_name ?> (<?= $row->address_city ?>, <?= $row->country_name ?>)</option>
								<?php endforeach; ?>
							</select>
							<?= form_error('location'); ?>
						</div>
						<div class="form-group">
							<label for="contact">Hauptkontaktperson</label>
							<select class="form-control" id="contact" name="contact">
								<option value="-">Auswählen ...</option>
								<?php foreach ($this->Employee->get_employee('filter:company', $this->session->partner['company_id'])->result() as $i => $row): ?>
								<option value="<?= $row->employee_id ?>" <?= (empty(form_error('contact')) ? ($company_main_contact == $row->employee_id ? 'selected' : '') : set_select('contact', $row->employee_id)) ?>><?= $row->employee_title ?> <?= $row->employee_firstname ?> <?= $row->employee_lastname ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('contact'); ?>
						</div>
						<div class="form-group">
							<label for="job-email">E-Mail für Jobangebote</label>
							<input type="email" class="form-control" id="job-email" name="job-email" placeholder="E-Mail-Adresse für Jobangebote" value="<?= empty(form_error('job-email')) ? $company_job_email : set_value('job-email') ?>">
							<p class="help-block">
								Diese E-Mail-Adresse wird bei Jobangeboten angezeigt, bei denen der jeweilige Standort keine eigene E-Mail-Adresse eingestellt hat.
							</p>
							<?= form_error('job-email') ?>
						</div>
						<div class="form-group">
							<label for="contact-email">E-Mail für die Kontaktaufnahme</label>
							<input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="E-Mail-Adresse für die Kontaktaufnahme" value="<?= empty(form_error('contact-email')) ? $company_contact_email : set_value('contact-email') ?>">
							<p class="help-block">
								Diese E-Mail-Adresse wird bei Ihrem Profil genutzt, um Absolventen die Kontaktaufnahme mit Ihnen einfacher zu gestalten.
							</p>
							<?= form_error('contact-email') ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="logo">Logo</label>
							<input type="file" id="logo" name="logo" accept="image/jpeg, image/jpg, image/png">
							<?php if (!empty($logo_error)) echo $this->config->item('error_prefix') . $logo_error . $this->config->item('error_suffix'); ?>
							<p class="help-block">Das Logo darf maximal eine Bildgröße von 3072x3072 Pixel haben und maximal 4 Megabyte groß sein.</p>
							<div class="logo-preview">
								<?= (!empty($company_logo_image_url) ? '<img src="'. base_url() . $company_logo_image_url .'">' : '') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="profile">Profilbild</label>
							<input type="file" id="profile" name="profile" accept="image/jpeg, image/jpg, image/png">
							<?php if (!empty($profile_error)) echo $this->config->item('error_prefix') . $profile_error . $this->config->item('error_suffix'); ?>
							<p class="help-block">Das Profilbild sollte quadratisch sein, darf maximal eine Bildgröße von 2048x2048 Pixel haben und maximal 4 Megabyte groß sein.</p>
							<div class="profile-preview">
								<?= (!empty($company_profile_image_url) ? '<img src="'. base_url() . $company_profile_image_url .'">' : '') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="banner">Profilbanner</label>
							<input type="file" id="banner" name="banner" accept="image/jpeg, image/jpg, image/png">
							<?php if (!empty($banner_error)) echo $this->config->item('error_prefix') . $banner_error . $this->config->item('error_suffix'); ?>
							<p class="help-block">Das Profilbanner darf maximal eine Bildgröße von 4096x4096 Pixel haben und maximal 8 Megabyte groß sein.</p>
							<div class="banner-preview">
								<?= (!empty($company_banner_image_url) ? '<img src="'. base_url() . $company_banner_image_url .'">' : '') ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>

	<form action="/partner/settings" method="post">
		<input type="hidden" name="form" value="sector-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Brancheneinstellungen
			</div>
			<div class="panel-body">
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Absolventen können diese Informationen sehen.
				</div>
				<div class="row">
					<?php 

					$sector_ids = array();
					$sectors = $this->Partner->get_partner_sectors($company_id)->result();

					foreach ($sectors as $i => $sector) {
						$sector_ids[$i] = $sector->sector_id;
					}

					foreach ($this->Job->get_sectors()->result() as $i => $row): 

					?>

					<div class="col-md-4 col-sm-6">
						<div class="checkbox" style="margin-top: 0">
							<label class="checkbox-inline">
								<input type="checkbox" class="sector" name="sectors[]" value="<?= $row->sector_id ?>" <?= (in_array($row->sector_id, $sector_ids) ? 'checked' : '') ?>> <?= $row->sector_name ?>
							</label>
						</div>
					</div>

					<?php endforeach; ?>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>

	<form action="/partner/settings" method="post">
		<input type="hidden" name="form" value="web-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Webauftrittseinstellungen
			</div>
			<div class="panel-body">
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Absolventen können diese Informationen sehen.
				</div>
				<div class="form-group">
					<label for="website">Webseite</label>
					<input type="text" class="form-control" id="website" name="website" placeholder="Webseite, URL" value="<?= empty(form_error('website')) ? $company_website : set_value('website') ?>">
					<?= form_error('website') ?>
				</div>
				<div class="form-group">
					<label for="facebook">Facebook</label>
					<input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?= empty(form_error('facebook')) ? $company_facebook : set_value('facebook') ?>">
					<?= form_error('facebook') ?>
				</div>
				<div class="form-group">
					<label for="google">Google+</label>
					<input type="text" class="form-control" id="google" name="google" placeholder="Google+" value="<?= empty(form_error('google')) ? $company_google_plus : set_value('google') ?>">
					<?= form_error('google') ?>
				</div>
				<div class="form-group">
					<label for="linkedin">LinkedIn</label>
					<input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn" value="<?= empty(form_error('linkedin')) ? $company_linkedin : set_value('linkedin') ?>">
					<?= form_error('linkedin') ?>
				</div>
				<div class="form-group">
					<label for="twitter">Twitter</label>
					<input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="<?= empty(form_error('twitter')) ? $company_twitter : set_value('twitter') ?>">
					<?= form_error('twitter') ?>
				</div>
				<div class="form-group">
					<label for="xing">XING</label>
					<input type="text" class="form-control" id="xing" name="xing" placeholder="XING" value="<?= empty(form_error('xing')) ? $company_xing : set_value('xing') ?>">
					<?= form_error('xing') ?>
				</div>
				<div class="form-group">
					<label for="youtube">YouTube</label>
					<input type="text" class="form-control" id="youtube" name="youtube" placeholder="YouTube" value="<?= empty(form_error('youtube')) ? $company_youtube : set_value('youtube') ?>">
					<?= form_error('youtube') ?>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>

	<form action="/partner/settings" method="post">
		<input type="hidden" name="form" value="change-password">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Passwort ändern
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="current-password">Aktuelles Passwort</label>
							<input type="password" class="form-control" id="current-password" name="current-password" placeholder="Aktuelles Passwort">
							<?php 

							if (!empty(form_error('current-password'))) {
								echo form_error('current-password');
							} else if (!empty($current_password_error)) {
								echo $this->config->item('error_prefix') . $current_password_error . $this->config->item('error_suffix'); 
							}

							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="new-password">Neues Passwort</label>
							<input type="password" class="form-control" id="new-password" name="new-password" placeholder="Neues Passwort">
							<?= form_error('new-password') ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="confirm-new-password">Neues Passwort bestätigen</label>
							<input type="password" class="form-control" id="confirm-new-password" name="confirm-new-password" placeholder="Neues Passwort bestätigen">
							<?= form_error('confirm-new-password') ?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>

	<form action="/partner/settings" method="post">
		<input type="hidden" name="form" value="misc-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Sonstige Einstellungen
			</div>
			<div class="panel-body">
				<div class="checkbox" style="margin-top: 0" id="adblock-notification">
					<label>
						<input type="checkbox" name="adblock-notification" value="on" <?= get_settings_item('partner', 'adblock_notification') ? 'checked' : '' ?>> Adblock-Meldung nicht mehr anzeigen
					</label><br />
					<label>
						<input type="checkbox" name="allow-newsletter" value="on" <?= $user_receive_newsletter ? 'checked' : '' ?>> Newsletter von Primus Romulus erhalten
					</label>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>
</div>