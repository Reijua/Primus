<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Newsletter senden</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie Ihren Newsletter <strong><?= $subject ?></strong> senden möchten?<br />
			<br />Empfänger:
			<strong><?= $empfänger ?></strong>
			<div id="post-preview">
				<h3>Vorschau</h3>
				<div class="row">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
			</div>
			<?php
				if(!empty($image) || !empty($file))
				{
					$string = "";
					if(!empty($image))
						$string = "Anhang: ".$image;
					if(!empty($file) && !empty($string))
						$string .= ", ".$file;
					else if(!empty($file))
						$string = "Anhang: ".$file;
					echo $string;
				}
			?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-success" id="send">Senden</button>
	</div>
</div>
<textarea style="display:none" id="text" name="text"><?= html_breaks($text) ?></textarea>
<script type="text/javascript">

$(document).ready(function() {
	$('#send').click(function(e) {
		e.stopImmediatePropagation();
		
		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		
		sendPost();
		return false;
	});

	function sendPost() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/admin/newsletter/send-newsletter/<?= $id ?>',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}
	
	var resetPreviewContent = $('#post-preview .row').html();
	
	$('#post-preview .row').html(resetPreviewContent);
	$('#post-preview').removeClass('hidden');

	var data = new FormData();
	data.append('form', true);
	data.append('subject', '<?= $subject ?>');
	data.append('text', $('#text').val());

	$.ajax({
		type: 'POST',
		url: '/admin/newsletter/preview-newsletter',
		data: data,
		contentType: false,
		processData: false,
		success: function(data) {
			$('#post-preview .row').html('<div class="col-md-7">' + data + '</div>');
			$('#post-preview .row .media-tag').html(image_tag);
		}
	});
	
});

</script>