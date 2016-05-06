<div class="container member-settings">

	<form action="/member/settings" method="post" enctype="multipart/form-data">
		<input type="hidden" name="form" value="personal-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Persönliche Einstellungen
			</div>
			<div class="panel-body">
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Andere Nutzer dieser Plattform (Absolventen und Unternehmen) können diese Informationen (außer E-Mail-Adresse und Geburtsdatum) sehen.
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
									<label for="birthdate">Geburtsdatum</label>
									<p class="form-control-static" id="birthdate"><?= DateTime::createFromFormat('Y-m-d', $member_birthday)->format('d.m.Y') ?></p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="title">Titel</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Titel" value="<?= empty(form_error('title')) ? $member_title : set_value('title') ?>">
							<?= form_error('title') ?>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="firstname">Vorname</label>
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Vorname" value="<?= empty(form_error('firstname')) ? $member_firstname : set_value('firstname') ?>">
									<?= form_error('firstname') ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="lastname">Nachname</label>
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nachname" value="<?= empty(form_error('lastname')) ? $member_lastname : set_value('lastname') ?>">
									<?= form_error('lastname') ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="image">Profilbild</label>
							<input type="file" id="image" name="image" accept="image/jpeg, image/jpg, image/png">
							<?php if (!empty($image_error)) echo $this->config->item('error_prefix') . $image_error . $this->config->item('error_suffix'); ?>
							<p class="help-block">Das Profilbild sollte quadratisch sein, darf maximal eine Bildgröße von 1024x1024 Pixel haben und maximal 2 Megabyte groß sein.</p>
							<div class="image-preview">
								<?= (!empty($member_profile_image_url) ? '<img src="'. base_url() . $member_profile_image_url .'">' : '') ?>
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

	<form action="/member/settings" method="post">
		<input type="hidden" name="form" value="specific-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Spezifische Einstellungen
			</div>
			<div class="panel-body">
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Andere Nutzer dieser Plattform (Absolventen und Unternehmen) können diese Informationen sehen.
				</div>
				<div class="form-group">
					<label for="about-text">Über mich</label>
					<textarea class="form-control" rows="8" id="about-text" name="about-text" placeholder="Über mich, Lebenslauf, Fähigkeiten"><?= empty(form_error('about-text')) ? html_breaks($member_about_text) : set_value('about-text') ?></textarea>
					<?= form_error('about-text'); ?>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="class">Abteilung | Abschlussjahr</label>
							<select class="form-control" id="class" name="class">
								<option value="-">Auswählen ...</option>
							<?php foreach ($this->Member->get_classes_departments()->result() as $i => $row): ?>
								<option value="<?= $row->class_id ?>" <?= ($row->class_id == $class_id ? 'selected' : '') ?>><?= $row->department_name ?> | <?= $row->class_end_year ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="company">Arbeitgeber</label>
							<input type="text" class="form-control" id="company" name="company" placeholder="Arbeitgeber, Firmenname" value="<?= empty(form_error('company')) ? html_breaks($company_name) : set_value('company') ?>">
							<?= form_error('company'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-sm">Speichern</button>
			</div>
		</div>
	</form>

	<form action="/member/settings" method="post">
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

	<form action="/member/settings" method="post">
		<input type="hidden" name="form" value="misc-settings">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Sonstige Einstellungen
			</div>
			<div class="panel-body">
				<div class="checkbox" style="margin-top: 0">
					<label>
						<input type="checkbox" name="allow-email-contact" value="on" <?= $member_allows_email_contact ? 'checked' : '' ?>> Andere Nutzer dieser Plattform (Absolventen und Unternehmen) dürfen mich per E-Mail kontaktieren
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
<script type="text/javascript">

$(document).ready(function() {
	var image_tag = '';
	$('#image').change(function() {
		if ($(this)[0].files && $(this)[0].files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				image_tag = '<img src="' + e.target.result + '">';
				$('.image-preview').html(image_tag);
			};

			reader.readAsDataURL($(this)[0].files[0]);
		}
	});
});

</script>