<div class="modal-content create-contact" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Kontaktperson bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="salutation">Anrede</label>
								<select class="form-control" id="salutation" name="salutation">
									<option value="-">Auswählen ...</option>
									<option value="female" <?= (empty(form_error('salutation')) ? ($salutation == 'female' ? 'selected' : '') : set_select('salutation', 'female')) ?>>Frau</option>
									<option value="male" <?= (empty(form_error('salutation')) ? ($salutation == 'male' ? 'selected' : '') : set_select('salutation', 'male')) ?>>Herr</option>
								</select>
								<?= form_error('salutation') ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="title">Titel</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Titel" value="<?= empty(form_error('title')) ? $title : set_value('title') ?>">
								<?= form_error('title'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="firstname">Vorname</label>
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Vorname" value="<?= empty(form_error('firstname')) ? $firstname : set_value('firstname') ?>">
						<?= form_error('firstname') ?>
					</div>
					<div class="form-group">
						<label for="lastname">Nachname</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nachname" value="<?= empty(form_error('lastname')) ? $lastname : set_value('lastname') ?>">
						<?= form_error('lastname') ?>
					</div>
					<div class="form-group">
						<label for="email">E-Mail</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="E-Mail-Adresse" value="<?= empty(form_error('email')) ? $email : set_value('email') ?>">
						<?= form_error('email') ?>
					</div>
					<div class="form-group">
						<label for="phone">Telefonnummer</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Telefonnummer" value="<?= empty(form_error('phone')) ? $phone : set_value('phone') ?>">
						<?= form_error('phone') ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="image">Portrait-Bild</label>
						<input type="file" id="image" name="image" accept="image/jpeg, image/jpg, image/png">
						<?php if (!empty($image_error)) echo $this->config->item('error_prefix') . $image_error . $this->config->item('error_suffix'); ?>
						<p class="help-block">Das Portrait-Bild sollte quadratisch sein, darf maximal eine Bildgröße von 1024x1024 Pixel haben und maximal 2 Megabyte groß sein.</p>
						<div class="image-preview">
							<?= (!empty($image_url) ? '<img src="'. base_url() . $image_url .'">' : '') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-success" id="save">Speichern</button>
	</div>
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

	$('#save').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		saveContact();

		return false;
	});

	function saveContact() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('salutation', $('#salutation').val());
		data.append('title', $('#title').val());
		data.append('firstname', $('#firstname').val());
		data.append('lastname', $('#lastname').val());
		data.append('email', $('#email').val());
		data.append('phone', $('#phone').val());
		data.append('image', $('#image')[0].files[0]);

		$.ajax({
			type: 'POST',
			url: '/partner/contacts/edit-contact/<?= $id ?>',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}
});

</script>