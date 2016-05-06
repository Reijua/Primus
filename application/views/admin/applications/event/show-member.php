<div class="modal-content" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Teilnehmer anzeigen</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			Für das Event <strong><?= $members->first_row()->event_name ?></strong> sind <strong><?= $members->num_rows() ?> Mitglieder</strong> eingetragen:
			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>E-Mail</th>
					</thead>
					<tbody>
						<?php foreach ($members->result() as $i => $row): ?>

						<tr>
							<td><?= $row->member_id ?></td>
							<td><?= $row->member_firstname.' '.$row->member_lastname ?></td>
							<td><?= $row->user_email ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success" data-dismiss="modal">Fertig</button>
	</div>
</div>