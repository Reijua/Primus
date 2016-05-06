<div class="modal-content edit-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Post bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="title">Titel</label>
						<input type="title" class="form-control" id="title" name="title" placeholder="Titel" value="<?= empty(form_error('title')) ? $title : set_value('title') ?>">
						<?= form_error('title'); ?>
					</div>
					<div class="form-group">
						<label for="text">Text</label>
						<textarea class="form-control" rows="12" id="text" name="text" placeholder="Text"><?= empty(form_error('text')) ? html_breaks($text) : set_value('text') ?></textarea>
						<?= form_error('text'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="image">Bild</label>
						<input type="file" id="image" name="image" accept="image/jpeg, image/jpg, image/png">
						<?php if (!empty($image_error)) echo $this->config->item('error_prefix') . $image_error . $this->config->item('error_suffix'); ?>
						<p class="help-block">Das Bild darf maximal eine Bildgröße von 2048x2048 Pixel haben und maximal 4 Megabyte groß sein.</p>
						<div class="image-preview"><?= !empty($image_url) ? '<img src="'. $image_url .'">' : '' ?></div>
						<label for="file">Datei</label>
						<input type="file" id="file" name="file">
						<?php if (!empty($file_error)) echo $this->config->item('error_prefix') . $file_error . $this->config->item('error_suffix'); ?>
						<p class="help-block">Die Datei darf maximal 8 Megabyte groß sein.</p>
						<?php 	if(!empty($attachment_url))
								{
									$explode = explode('/', $attachment_url);
									echo $explode[sizeof($explode)-1];
								} ?>
						<label for="video">Video</label>
						<input type="file" id="video" name="video">
						<?php if (!empty($video_error)) echo $this->config->item('error_prefix') . $video_error . $this->config->item('error_suffix'); ?>
						<p class="help-block">Das Video darf maximal 90 Megabyte groß und vom Typ .mp4 sein.</p>
						<?php 	if(!empty($video_url))
								{
									$explode = explode('/', $video_url);
									echo $explode[sizeof($explode)-1];
								} ?>
					</div>
				</div>
			</div>
			<div id="post-preview" class="hidden">
				<h3>Vorschau</h3>
				<div class="row">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Die Darstellung eines Posts kann für Absolventen je nach der Bildschirmauflösung des verwendeten Geräts variieren.
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
		savePost();

		return false;
	});

	$('#preview').click(function(e) {
		e.stopImmediatePropagation();
		createPreview();
		return false;
	});

	function savePost() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('text', $('#text').val());
		data.append('image', $('#image')[0].files[0]);
		data.append('file', $('#file')[0].files[0]);
		data.append('video', $('#video')[0].files[0]);

		$.ajax({
			type: 'POST',
			url: '/partner/feed/edit-post/<?= $id ?>',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}

	var resetPreviewContent = $('#post-preview .row').html();
	function createPreview() {
		$('#post-preview .row').html(resetPreviewContent);
		$('#post-preview').removeClass('hidden');

		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('text', $('#text').val());

		$.ajax({
			type: 'POST',
			url: '/partner/feed/preview-post',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#post-preview .row').html('<div class="col-md-7">' + data + '</div>');

				if (image_tag == '') {
					image_tag = $('.image-preview').html();
				}

				$('#post-preview .row .media-tag').html(image_tag);
			}
		});
	}
});

</script>