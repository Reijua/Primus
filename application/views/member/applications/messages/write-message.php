<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Nachricht schreiben</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="form-group">
					<label for="recipient">An</label>
					<p class="form-control-static"><?= $recipient ?></p>
				</div>
				<div class="form-group">
					<label for="subject">Betreff</label>
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Betreff" value="<?= set_value('subject') ?>">
					<?= form_error('subject'); ?>
				</div>
				<div class="form-group">
					<label for="message">Nachricht</label>
					<textarea class="form-control" rows="12" id="message" name="message" placeholder="Text"><?= set_value('message') ?></textarea>
					<?= form_error('message'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-success" id="write">Schreiben</button>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#write').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		writeMessage();
		
		return false;
	});

	function writeMessage() {
		var data = new FormData();
		data.append('form', true);
		data.append('subject', $('#subject').val());
		data.append('message', $('#message').val());

		$.ajax({
			type: 'POST',
			url: '/member/messages/write-message/<?= $id ?>',
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