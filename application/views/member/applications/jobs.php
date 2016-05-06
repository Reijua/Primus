<div class="container">
	<form class="form-horizontal">
		<input type="hidden" name="form" value="true">
		<div class="form-group">
			<label for="term" class="col-sm-2 control-label">Begriff</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="term" name="term" placeholder="Beruf, Begriff">
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
			<label for="type" class="col-sm-2 control-label">Anstellungsart</label>
			<div class="col-sm-10">
				<div class="row">
					<?php foreach ($this->Job->get_types()->result() as $i => $row): ?>

					<div class="col-md-4 col-sm-6">
						<label class="checkbox-inline">
							<input type="checkbox" class="type" name="types[]" value="<?= $row->type_id ?>"> <?= $row->type_name ?>
						</label>
					</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" class="btn btn-default" id="search">Jobangebote suchen</button>
			</div>
		</div>
	</form>
	<div class="job-results">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12" id="job-results"></div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#search').click(function(e) {
		e.stopImmediatePropagation();

		// Change content to be the loading icon
		$('#job-results').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

		$.ajax({
			type: 'POST',
			url: '/job/search',
			data: $('form').serialize(),
			success: function(data, status, xhr) {
				if (xhr.getResponseHeader('Content-Type') == 'application/json') {
					// The response is an error message
					$('#job-results').html('<div class="job-error">' + data.error + '</div>');
				} else {
					$('#job-results').html(data);
				}
			}
		});

		return false;
	});
});

</script>