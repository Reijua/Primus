<div class="modal-content edit-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Benutzer Sperren</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sie sind dabei, den Benutzer <strong><?= $vorname ?> <?= $nachname ?></strong> mit der E-Mail <strong><?= $email ?></strong> zu sperren.
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="duration">Dauer in Stunden (-1 ist dauerhaft)</label>
						<input type="duration" class="form-control" id="duration" name="duration" placeholder="Dauer" value="24">
						<?= form_error('duration'); ?>
					</div>
					<div class="form-group">
						<label for="reason">Grund</label>
						<textarea class="form-control" rows="12" id="reason" name="reason" placeholder="Grund"></textarea>
						<?= form_error('reason'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-danger" id="save">Sperren</button>
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
		data.append('duration', $('#duration').val());
		data.append('reason', $('#reason').val());

		$.ajax({
			type: 'POST',
			url: '/admin/memberfunction/ban/<?= $id ?>',
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