<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Jobangebot <?= ($open == 0 ? 'öffnen' : 'schließen') ?></h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie Ihr Jobangebot
			<div style="margin: 15px"><strong><?= $title ?></strong></div>
			<?= ($open == 0 ? 'öffnen' : 'schließen') ?> möchten?
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<?php if ($open == 0): // Job is closed ?>
		<button type="button" class="btn btn-success" id="toggle">Öffnen</button>
		<?php else: // Job is open ?>
		<button type="button" class="btn btn-danger" id="toggle">Schließen</button>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#toggle').click(function(e) {
		e.stopImmediatePropagation();
		toggleJob();
		return false;
	});

	function toggleJob() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/partner/jobs/toggle-job/<?= $id ?>',
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