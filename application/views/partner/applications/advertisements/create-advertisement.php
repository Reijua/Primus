<div class="modal-content create-advertisement" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Werbung schalten</h4>
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
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="url-text">URL-Text</label>
								<input type="text" class="form-control" id="url-text" name="url-text" placeholder="URL-Text" value="<?= set_value('url-text') ?>">
								<?= form_error('url-text'); ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="url">URL</label>
								<input type="text" class="form-control" id="url" name="url" placeholder="URL (Webadresse)" value="<?= set_value('url') ?>">
								<?= form_error('url'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="text">Text</label>
						<textarea class="form-control" rows="8" id="text" name="text" placeholder="Text"><?= set_value('text') ?></textarea>
						<?= form_error('text'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="start-date">Geschaltet von</label>
								<input type="text" class="form-control" id="start-date" name="start-date" placeholder="Geschaltet von" value="<?= set_value('start-date') ?>">
								<?= form_error('start-date'); ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="end-date">Geschaltet bis</label>
								<input type="text" class="form-control" id="end-date" name="end-date" placeholder="Geschaltet bis" value="<?= set_value('end-date') ?>" disabled>
								<?= form_error('end-date'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="image">Bild</label>
						<input type="file" id="image" name="image" accept="image/jpeg, image/jpg, image/png">
						<?php if (!empty($image_error)) echo $this->config->item('error_prefix') . $image_error . $this->config->item('error_suffix'); ?>
						<p class="help-block">Das Bild darf maximal eine Bildgröße von 512x512 Pixel haben und maximal 1 Megabyte groß sein.</p>
						<div class="image-preview"></div>
					</div>
				</div>
			</div>
			<div id="advertisement-preview" class="hidden">
				<h3>Vorschau</h3>
				<div class="row">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Die Darstellung einer Werbung kann für Absolventen je nach der Bildschirmauflösung des verwendeten Geräts variieren.
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-primary" id="preview">Vorschau</button>
		<button type="button" class="btn btn-success" id="save">Speichern</button>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#start-date').datetimepicker({
		locale: <?= get_cookie('language') == 'english' ? "'en-gb'" : "'de'" ?>,
		format: 'L'
	});

	$('#end-date').datetimepicker({
		locale: <?= get_cookie('language') == 'english' ? "'en-gb'" : "'de'" ?>,
		format: 'L'
	});

	$('#start-date').on('dp.change', function(e) {
		var endDate = $('#end-date');

		endDate.prop('disabled', false);
		endDate.val(e.date.format('DD.MM.YYYY'));

		endDate.data('DateTimePicker').minDate(e.date);
		endDate.data('DateTimePicker').maxDate(e.date.add(<?= $this->config->item('advertisement_max_interval') ?>, 'days'));
	});

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
		saveAdvertisement();

		return false;
	});

	$('#preview').click(function(e) {
		e.stopImmediatePropagation();
		createPreview();
		return false;
	});

	function saveAdvertisement() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('url', $('#url').val());
		data.append('url-text', $('#url-text').val());
		data.append('text', $('#text').val());
		data.append('start-date', $('#start-date').val());
		data.append('end-date', $('#end-date').val());
		data.append('image', $('#image')[0].files[0]);

		$.ajax({
			type: 'POST',
			url: '/partner/advertisements/create-advertisement',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}

	var resetPreviewContent = $('#advertisement-preview .row').html();
	function createPreview() {
		$('#advertisement-preview .row').html(resetPreviewContent);
		$('#advertisement-preview').removeClass('hidden');

		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('url', $('#url').val());
		data.append('url-text', $('#url-text').val());
		data.append('text', $('#text').val());

		$.ajax({
			type: 'POST',
			url: '/partner/advertisements/preview-advertisement',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#advertisement-preview .row').html('<div class="col-md-5">' + data + '</div>');
				$('#advertisement-preview .row .media-tag').html(image_tag);
			}
		});
	}
});

</script>