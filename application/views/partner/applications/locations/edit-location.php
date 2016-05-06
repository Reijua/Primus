<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Standort bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="name">Bezeichnung</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name, Bezeichnung" value="<?= empty(form_error('name')) ? $name : set_value('name') ?>">
						<?= form_error('name'); ?>
					</div>
					<div class="form-group">
						<label for="street">Straße</label>
						<input type="text" class="form-control" id="street" name="street" placeholder="Straße" value="<?= empty(form_error('street')) ? $street : set_value('street') ?>">
						<?= form_error('street'); ?>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label for="zipcode">Postleitzahl</label>
								<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postleitzahl" value="<?= empty(form_error('zipcode')) ? $zipcode : set_value('zipcode') ?>">
								<?= form_error('zipcode'); ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label for="city">Ort</label>
								<input type="text" class="form-control" id="city" name="city" placeholder="Ort, Stadt" value="<?= empty(form_error('city')) ? $city : set_value('city') ?>">
								<?= form_error('city'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="country">Land</label>
						<select class="form-control" id="country" name="country">
							<option value="-">Auswählen ...</option>
							<?php foreach ($this->Location->get_countries()->result() as $i => $row): ?>
							<option value="<?= $row->country_id ?>" <?= (empty(form_error('country')) ? ($country == $row->country_id ? 'selected' : '') : set_select('country', $row->country_id)) ?>><?= $row->country_name ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('country'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="phone">Telefonnummer</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Telefonnummer" value="<?= empty(form_error('phone')) ? $phone : set_value('phone') ?>">
						<?= form_error('phone'); ?>
					</div>
					<div class="form-group">
						<label for="fax">Faxnummer</label>
						<input type="text" class="form-control" id="fax" name="fax" placeholder="Faxnummer" value="<?= empty(form_error('fax')) ? $fax : set_value('fax') ?>">
						<?= form_error('fax'); ?>
					</div>
					<div class="form-group">
						<label for="email">E-Mail</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail-Addresse" value="<?= empty(form_error('email')) ? $email : set_value('email') ?>">
						<?= form_error('email'); ?>
					</div>
					<div class="form-group">
						<label for="website">Webseite</label>
						<input type="text" class="form-control" id="website" name="website" placeholder="Webseite, URL" value="<?= empty(form_error('website')) ? $website : set_value('website') ?>">
						<?= form_error('website'); ?>
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
	$('#save').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		saveLocation();

		return false;
	});

	function saveLocation() {
		var data = new FormData();
		data.append('form', true);
		data.append('name', $('#name').val());
		data.append('street', $('#street').val());
		data.append('zipcode', $('#zipcode').val());
		data.append('city', $('#city').val());
		data.append('country', $('#country').val());
		data.append('phone', $('#phone').val());
		data.append('fax', $('#fax').val());
		data.append('email', $('#email').val());
		data.append('website', $('#website').val());

		$.ajax({
			type: 'POST',
			url: '/partner/locations/edit-location/<?= $id ?>',
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