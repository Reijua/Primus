<div class="container">
	<?php if (!empty($type) && !empty($message)): ?>

	<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
		<?= $message ?>
	</div>

	<?php endif; ?>
</div>