<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Werbung <?= ($enabled == 0 ? '' : 'de') ?>aktivieren</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie Ihre Werbung
			<div style="margin: 15px"><strong><?= $title ?></strong></div>
			<?= ($enabled == 0 ? '' : 'de') ?>aktivieren möchten?
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<?php if ($enabled == 0): // Advertisement is disabled ?>
		<button type="button" class="btn btn-success" id="toggle">Aktivieren</button>
		<?php else: // Advertisement is enabled ?>
		<button type="button" class="btn btn-danger" id="toggle">Deaktivieren</button>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#toggle').click(function(e) {
		e.stopImmediatePropagation();
		toggleAdvertisement();
		return false;
	});

	function toggleAdvertisement() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/partner/advertisements/toggle-advertisement/<?= $id ?>',
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