<div class="container partner-feed">
	<h3>Member, die auf eine aktivierung warten</h3>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Registrierungsdatum</th>
				<th>Vorname</th>
				<th>Nachname</th>
				<th>E-Mail</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Admin->get_users_to_activate()->result() as $i => $row): ?>

				<tr>
					<td><?= $row->member_id ?></td>
					<td><?= date('d.m.Y', strtotime($row->user_registration_date)) ?></td>
					<td><?= $row->member_firstname ?></td>
					<td><?= $row->member_lastname ?></td>
					<td><?= $row->user_email ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/memberfunction/activate/<?= $row->member_id ?>" role="button">Aktivieren</a>
						<a class="btn btn-danger btn-xs load-modal" style="margin-top: 0px;" data-source="/admin/memberfunction/ban/<?= $row->member_id ?>" role="button">Sperren</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: activate, ban -->