<?php if (!empty($type) && !empty($message)): ?>

<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close"><span aria-hidden="true">&times;</span></button>
	<?= $message ?>
</div>

<?php if (!empty($on_close)): ?>
<script type="text/javascript">

$(document).ready(function() {
	$('#close').click(function(e) {
		<?php if ($on_close == 'reload'): ?>

		location.reload();
		
		<?php endif; ?>
	});
});

</script>
<?php endif; ?>

<?php endif; ?>