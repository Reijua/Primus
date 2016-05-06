<div class="container partner-feed">
	<h3>Alle gebannten Member</h3>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Registrierungsd.</th>
				<th>Von</th>
				<th>Bis</th>
				<th>Grund</th>
				<th>Vorname</th>
				<th>Nachname</th>
				<th>E-Mail</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Admin->get_all_banned_users()->result() as $i => $row): ?>

				<tr>
					<td><?= $row->member_id ?></td>
					<td><?= date('d.m.Y', strtotime($row->user_registration_date)) ?></td>
					<td><?= date('d.m.Y', strtotime($row->memberblocking_start_date)) ?></td>
					<td><?= date('d.m.Y', strtotime($row->memberblocking_end_date)) == '01.01.1970' ? 'dauerhaft' : date('d.m.Y', strtotime($row->memberblocking_end_date)) ?></td>
					<td><?= $row->memberblocking_reason ?></td>
					<td><?= $row->member_firstname ?></td>
					<td><?= $row->member_lastname ?></td>
					<td><?= $row->user_email ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/memberfunction/unban/<?= $row->member_id ?>/<?= $row->memberblocking_id ?>" role="button">Entsperren</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>