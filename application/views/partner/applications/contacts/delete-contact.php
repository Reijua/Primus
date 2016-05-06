<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Kontaktperson löschen</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie Ihre Kontaktperson
			<div style="margin: 15px"><strong><?= $title ?> <?= $firstname ?> <?= $lastname ?></strong></div>
			löschen möchten?
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-danger" id="delete">Löschen</button>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#delete').click(function(e) {
		e.stopImmediatePropagation();
		deleteContact();
		return false;
	});

	function deleteContact() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/partner/contacts/delete-contact/<?= $id ?>',
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