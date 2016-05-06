<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Nutzer aktivieren</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie den Benutzer <strong><?= $vorname ?> <?= $nachname ?></strong> mit der E-Mail <strong><?= $email ?></strong> aktivieren möchten?
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-success" id="activate">Aktivieren</button>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#activate').click(function(e) {
		e.stopImmediatePropagation();
		activate();
		return false;
	});

	function activate() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/admin/memberfunction/activate/<?= $id ?>',
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