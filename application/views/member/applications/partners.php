<div class="container">
	<form class="form-horizontal">
		<input type="hidden" name="form" value="true">
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="name" name="name" placeholder="Firma, Name">
			</div>
		</div>
		<div class="form-group">
			<label for="location" class="col-sm-2 control-label">Ort</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="location" name="location" placeholder="Ort, Stadt, Land">
			</div>
		</div>
		<div class="form-group">
			<label for="sector" class="col-sm-2 control-label">Branche</label>
			<div class="col-sm-10">
				<div class="row">
					<?php foreach ($this->Job->get_sectors()->result() as $i => $row): ?>

					<div class="col-md-4 col-sm-6">
						<label class="checkbox-inline">
							<input type="checkbox" class="sector" name="sectors[]" value="<?= $row->sector_id ?>"> <?= $row->sector_name ?>
						</label>
					</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" class="btn btn-default" id="search">Unternehmen suchen</button>
			</div>
		</div>
	</form>
	<div class="partner-results">
		<div class="row" id="partner-results"></div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#search').click(function(e) {
		e.stopImmediatePropagation();

		// Change content to be the loading icon
		$('#partner-results').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

		$.ajax({
			type: 'POST',
			url: '/partner/search',
			data: $('form').serialize(),
			success: function(data, status, xhr) {
				if (xhr.getResponseHeader('Content-Type') == 'application/json') {
					// The response is an error message
					$('#partner-results').html('<div class="partner-error">' + data.error + '</div>');
				} else {
					$('#partner-results').html(data);
				}
			}
		});

		return false;
	});
});

</script>