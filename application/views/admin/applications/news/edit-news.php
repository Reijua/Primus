<div class="modal-content edit-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">News bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="title">Titel</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Titel" value="<?= empty(form_error('title')) ? $title : set_value('title') ?>">
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
		savePost();

		return false;
	});

	function savePost() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('title', $('#title').val());
		data.append('text', $('#text').val());
		data.append('image', $('#image')[0].files[0]);

		$.ajax({
			type: 'POST',
			url: '/admin/news/edit-news/<?= $id ?>',
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