<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Newsletter löschen</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Sind Sie sicher, dass Sie Ihren Newsletter
			<div style="margin: 15px"><strong><?= $subject ?></strong></div>
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
		deletePost();
		return false;
	});

	function deletePost() {
		var data = new FormData();
		data.append('form', true);

		$.ajax({
			type: 'POST',
			url: '/admin/newsletter/delete-newsletter/<?= $id ?>',
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