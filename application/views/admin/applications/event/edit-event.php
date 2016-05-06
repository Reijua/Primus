<div class="modal-content edit-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Event bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= empty(form_error('name')) ? $name : set_value('name') ?>">
						<?= form_error('name'); ?>
					</div>
					<div class="form-group">
						<label for="description">Beschreibung</label>
						<textarea class="form-control" rows="12" id="description" name="description" placeholder="Beschreibung"><?= empty(form_error('description')) ? html_breaks($description) : set_value('description') ?></textarea>
						<?= form_error('description'); ?>
					</div>
					<div class="form-group">
						<label for="startdate">Beginn</label>
						<input type="text" class="form-control" id="startdate" name="startdate" placeholder="Beginn" value="<?=  empty(form_error('startdate')) ? $startdate : set_value('startdate') ?>">
						<?= form_error('startdate') ?>
					</div>
					<div class="form-group">
						<label for="enddate">Ende</label>
						<input type="text" class="form-control" id="enddate" name="enddate" placeholder="Ende" value="<?= empty(form_error('enddate')) ? $enddate : set_value('enddate') ?>">
						<?= form_error('enddate') ?>
					</div>
				</div>
				<div class="col-lg-6">
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
							<option value="<?= $row->country_id ?>" <?= set_select('country', $row->country_id) ?> <?= $row->country_id == $country ? ' selected' : '' ?>><?= $row->country_name ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('country'); ?>
					</div>
					<div class="form-group">
						<label for="leader">Verantwortlicher</label>
						<select class="form-control" id="leader" name="leader">
							<option value="-">Auswählen ...</option>
							<?php foreach ($member as $i => $row): ?>
							<option value="<?= $row->member_id ?>" <?= set_select('leader', $row->member_id) ?> <?= $row->member_id == $leader ? ' selected' : '' ?>><?= $row->member_firstname.' '.$row->member_lastname ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('leader'); ?>
					</div>
					<div class="form-group">
						<label for="eventtype">Typ</label>
						<select class="form-control" id="eventtype" name="eventtype">
							<option value="-">Auswählen ...</option>
							<?php foreach ($eventtype as $i => $row): ?>
							<option value="<?= $row->eventtype_id ?>" <?= set_select('eventtype', $row->eventtype_id) ?> <?= $row->eventtype_id == $eventtype_id ? ' selected' : '' ?>><?= $row->eventtype_name ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('eventtype'); ?>
					</div>
					<div class="form-group">
						<label for="maxmember">Maximale Teilnehmeranzahl</label>
						<input type="text" class="form-control" id="maxmember" name="maxmember" placeholder="Teilnehmeranzahl" value="<?= empty(form_error('maxmember')) ? $maxmember : set_value('maxmember') ?>">
						<?= form_error('maxmember'); ?>
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
		savePost();

		return false;
	});

	function savePost() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('name', $('#name').val());
		data.append('description', $('#description').val());
		data.append('startdate', $('#startdate').val());
		data.append('enddate', $('#enddate').val());
		data.append('street', $('#street').val());
		data.append('zipcode', $('#zipcode').val());
		data.append('city', $('#city').val());
		data.append('country', $('#country').val());
		data.append('leader', $('#leader').val());
		data.append('eventtype', $('#eventtype').val());
		data.append('maxmember', $('#maxmember').val());

		$.ajax({
			type: 'POST',
			url: '/admin/event/edit-event/<?= $id ?>',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}

	
	$(function() {
		$('#startdate').datetimepicker({
			locale: 'de',
			format: 'DD.MM.YYYY HH:mm',
			minDate: moment('01/01/2015')
		});
		
		$('#enddate').datetimepicker({
			locale: 'de',
			format: 'DD.MM.YYYY HH:mm',
			minDate: moment('01/01/2015')
		});
	});
	
});
</script>