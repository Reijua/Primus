<div class="modal-content create-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Partner erstellen</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="email">E-Mail</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?= set_value('email') ?>">
						<?= form_error('email'); ?>
					</div>
					<div class="form-group">
						<label for="password">Passwort</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Passwort" value="<?= set_value('password') ?>">
						<?= form_error('password'); ?>
					</div>
					<div class="form-group">
						<label for="confirm-password">Passwort wiederholen</label>
						<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Passwort wiederholen" value="<?= set_value('confirm-password') ?>">
						<?= form_error('confirm-password'); ?>
					</div>
					<div class="form-group">
						<label for="company-name">Firmenname</label>
						<input type="text" class="form-control" id="company-name" name="company-name" placeholder="Firmenname" value="<?= set_value('company-name') ?>">
						<?= form_error('company-name'); ?>
					</div>
					<div class="form-group">
						<label>Paket</label><br />
						<label for="bronze">
							<input type="radio" name="packet" value="1" id="bronze" <?php echo set_value('packet', '1'); ?> checked> Bronze
						</label><br />
						<label for="silber">
							<input type="radio" name="packet" value="2" id="silber" <?php echo set_value('packet', '2'); ?>> Silber
						</label><br />
						<label for="gold">
							<input type="radio" name="packet" value="3" id="gold" <?php echo set_value('packet', '3'); ?>> Gold
						</label>
						<?= form_error('packet'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="name">Bezeichnung</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name, Bezeichnung" value="<?= set_value('name') ?>">
						<?= form_error('name'); ?>
					</div>
					<div class="form-group">
						<label for="street">Straße</label>
						<input type="text" class="form-control" id="street" name="street" placeholder="Straße" value="<?= set_value('street') ?>">
						<?= form_error('street'); ?>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label for="zipcode">Postleitzahl</label>
								<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postleitzahl" value="<?= set_value('zipcode') ?>">
								<?= form_error('zipcode'); ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label for="city">Ort</label>
								<input type="text" class="form-control" id="city" name="city" placeholder="Ort, Stadt" value="<?= set_value('city') ?>">
								<?= form_error('city'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="country">Land</label>
						<select class="form-control" id="country" name="country">
							<option value="-">Auswählen ...</option>
							<?php foreach ($this->Location->get_countries()->result() as $i => $row): ?>
							<option value="<?= $row->country_id ?>" <?= set_select('country', $row->country_id) ?>><?= $row->country_name ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('country'); ?>
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
	$('#save').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		savePost();

		return false;
	});

	function savePost() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('email', $('#email').val());
		data.append('password', $('#password').val());
		data.append('confirm-password', $('#confirm-password').val());
		data.append('packet', $("input[name='packet']:checked").val());
		data.append('company-name', $('#company-name').val());
		data.append('name', $('#name').val());
		data.append('street', $('#street').val());
		data.append('zipcode', $('#zipcode').val());
		data.append('city', $('#city').val());
		data.append('country', $('#country').val());

		$.ajax({
			type: 'POST',
			url: '/admin/partnerfunction/create-partner',
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