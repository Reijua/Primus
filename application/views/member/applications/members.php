<div class="container">
	<form class="form-horizontal">
		<input type="hidden" name="form" value="true">
		<input type="hidden" name="usertype" value="member">
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="name" name="name" placeholder="Name">
			</div>
		</div>
		<div class="form-group">
			<label for="sector" class="col-sm-2 control-label">Abteilung</label>
			<div class="col-sm-10">
				<div class="row">
					<?php foreach ($this->Member->get_departments()->result() as $i => $row): ?>

					<div class="col-md-3 col-sm-4">
						<label class="checkbox-inline">
							<input type="checkbox" class="department" name="departments[]" value="<?= $row->department_id ?>"> <?= $row->department_name ?>
						</label>
					</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="sector" class="col-sm-2 control-label">Abschlussjahr</label>
			<div class="col-sm-10">
				<div class="row">
					<?php 

					foreach ($this->Member->get_classes()->result() as $i => $row): 

						// Check if the year is a valid start year for members
						$today = date('Y-m-d H:i:s');
						$date = $row->class_end_year .'-07-01 00:00:00';

						if ($date < $today):
					
					?>

					<div class="col-md-3 col-sm-4 col-xs-6">
						<label class="checkbox-inline">
							<input type="checkbox" class="class" name="classes[]" value="<?= $row->class_end_year ?>"> <?= $row->class_end_year ?>
						</label>
					</div>

					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" class="btn btn-default" id="search">Absolventen suchen</button>
			</div>
		</div>
	</form>
	<div class="member-results">
		<div class="row" id="member-results"></div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#search').click(function(e) {
		e.stopImmediatePropagation();

		// Change content to be the loading icon
		$('#member-results').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

		$.ajax({
			type: 'POST',
			url: '/member/search',
			data: $('form').serialize(),
			success: function(data, status, xhr) {
				if (xhr.getResponseHeader('Content-Type') == 'application/json') {
					// The response is an error message
					$('#member-results').html('<div class="member-error">' + data.error + '</div>');
				} else {
					$('#member-results').html(data);
				}
			}
		});

		return false;
	});
});

</script>