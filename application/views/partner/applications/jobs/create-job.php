<?php

$tasks = array('');
$requirements = array('');

if (!empty(set_value('tasks[0]'))) {
	parse_str(set_value('tasks[0]'), $tasks);

	if (!isset($tasks['tasks'])) {
		$tasks['tasks'] = array();
	}

	if (!isset($tasks['amp;tasks'])) {
		$tasks['amp;tasks'] = array();
	}

	$tasks = array_merge($tasks['tasks'], $tasks['amp;tasks']);
}

if (!empty(set_value('requirements[0]'))) {
	parse_str(set_value('requirements[0]'), $requirements);

	if (!isset($requirements['requirements'])) {
		$requirements['requirements'] = array();
	}

	if (!isset($requirements['amp;requirements'])) {
		$requirements['amp;requirements'] = array();
	}

	$requirements = array_merge($requirements['requirements'], $requirements['amp;requirements']);
}

?>

<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Jobangebot erstellen</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="title">Titel</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Titel" value="<?= set_value('title') ?>">
						<?= form_error('title'); ?>
					</div>
					<div class="form-group">
						<label for="lead-text">Vorwort</label>
						<textarea class="form-control" rows="4" id="lead-text" name="lead-text" placeholder="Vorwort"><?= set_value('lead-text') ?></textarea>
						<?= form_error('lead-text'); ?>
					</div>
					<div class="form-group">
						<label for="text">Text</label>
						<textarea class="form-control" rows="8" id="text" name="text" placeholder="Text"><?= set_value('text') ?></textarea>
						<?= form_error('text'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="salary-text">Gehaltsangabe</label>
						<textarea class="form-control" rows="4" id="salary-text" name="salary-text" placeholder="Gehaltsangabe"><?= set_value('salary-text') ?></textarea>
						<?= form_error('salary-text'); ?>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control" id="status" name="status">
									<option value="0">Geschlossen</option>
									<option value="1" selected>Offen</option>
								</select>
								<?= form_error('status'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="start-date">Eintrittsdatum</label>
								<input type="text" class="form-control" id="start-date" name="start-date" placeholder="Eintrittsdatum" value="<?= set_value('start-date') ?>">
								<?= form_error('start-date'); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact">Kontaktperson</label>
								<select class="form-control" id="contact" name="contact">
									<option value="-">Auswählen ...</option>
									<?php foreach ($this->Employee->get_employee('filter:company', $this->session->partner['company_id'])->result() as $i => $row): ?>
									<option value="<?= $row->employee_id ?>"><?= $row->employee_title ?> <?= $row->employee_firstname ?> <?= $row->employee_lastname ?></option>
									<?php endforeach; ?>
								</select>
								<?= form_error('contact'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="type">Anstellungsart</label>
								<select class="form-control" id="type" name="type">
									<option value="-">Auswählen ...</option>
									<?php foreach ($this->Job->get_types()->result() as $i => $row): ?>
									<option value="<?= $row->type_id ?>"><?= $row->type_name ?></option>
									<?php endforeach; ?>
								</select>
								<?= form_error('type'); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="location">Standort</label>
								<select class="form-control" id="location" name="location">
									<option value="-">Auswählen ...</option>
									<?php foreach ($this->Location->get_location('filter:company', $this->session->partner['company_id'])->result() as $i => $row): ?>
									<option value="<?= $row->location_id ?>"><?= $row->location_name ?> (<?= $row->address_city ?>, <?= $row->country_name ?>)</option>
									<?php endforeach; ?>
								</select>
								<?= form_error('location'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sector">Branche</label>
								<select class="form-control" id="sector" name="sector">
									<option value="-">Auswählen ...</option>
									<?php foreach ($this->Job->get_sectors()->result() as $i => $row): ?>
									<option value="<?= $row->sector_id ?>"><?= $row->sector_name ?></option>
									<?php endforeach; ?>
								</select>
								<?= form_error('sector'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="task">Aufgaben</label> <a class="btn btn-info btn-xs" id="add-task">+ Feld hinzufügen</a>
						<?php foreach ($tasks as $i => $task): ?>
						<input type="text" class="form-control task" name="tasks[]" placeholder="Aufgabe" style="margin-bottom: 5px" value="<?= $task ?>">
						<?php endforeach; ?>
						<p class="help-block">Leere Eingabefelder bei den Aufgaben werden ignoriert.</p>
						<?= form_error('tasks[]'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="requirement">Anforderungen</label> <a class="btn btn-info btn-xs" id="add-requirement">+ Feld hinzufügen</a>
						<?php foreach ($requirements as $i => $requirement): ?>
						<input type="text" class="form-control requirement" name="requirements[]" placeholder="Anforderung" style="margin-bottom: 5px" value="<?= $requirement ?>">
						<?php endforeach; ?>
						<p class="help-block">Leere Eingabefelder bei den Anforderungen werden ignoriert.</p>
						<?= form_error('requirements[]'); ?>
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
	$('#start-date').datetimepicker({
		locale: <?= get_cookie('language') == 'english' ? "'en-gb'" : "'de'" ?>,
		format: 'L'
	});

	$('#add-task').click(function(e) {
		e.stopImmediatePropagation();

		if ($('input.task').length != 0) {
			$('input.task').last().after('<input type="text" class="form-control task" name="tasks[]" placeholder="Aufgabe" style="margin-bottom: 5px">');
		} else {
			$('#add-task').after('<input type="text" class="form-control task" name="tasks[]" placeholder="Aufgabe" style="margin-bottom: 5px">');
		}

		return false;
	});

	$('#add-requirement').click(function(e) {
		e.stopImmediatePropagation();

		if ($('input.requirement').length != 0) {
			$('input.requirement').last().after('<input type="text" class="form-control requirement" name="requirements[]" placeholder="Anforderung" style="margin-bottom: 5px">');
		} else {
			$('#add-requirement').after('<input type="text" class="form-control requirement" name="requirements[]" placeholder="Anforderung" style="margin-bottom: 5px">');
		}

		return false;
	});

	$('#save').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		saveJob();

		return false;
	});

	function saveJob() {
		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('lead-text', $('#lead-text').val());
		data.append('text', $('#text').val());
		data.append('salary-text', $('#salary-text').val());
		data.append('start-date', $('#start-date').val());
		data.append('status', $('#status').val());
		data.append('contact', $('#contact').val());
		data.append('type', $('#type').val());
		data.append('location', $('#location').val());
		data.append('sector', $('#sector').val());
		data.append('tasks[]', $('input.task').serialize());
		data.append('requirements[]', $('input.requirement').serialize());

		$.ajax({
			type: 'POST',
			url: '/partner/jobs/create-job',
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