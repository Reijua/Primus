<div class="container partner-feed">
	<h3>Alle nicht gebannten Member</h3>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Registrierd.</th>
				<th>Firma</th>
				<th>Titel</th>
				<th>Vorname</th>
				<th>Nachname</th>
				<th>E-Mail</th>
				<th>Newsletter</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Admin->get_all_users_not_banned()->result() as $i => $row): ?>

				<tr>
					<td><?= $row->member_id ?></td>
					<td><?= date('d.m.Y', strtotime($row->user_registration_date)) ?></td>
					<td><?= $row->company_name ?></td>
					<td><?= $row->member_title ?></td>
					<td><?= $row->member_firstname ?></td>
					<td><?= $row->member_lastname ?></td>
					<td><?= $row->user_email ?></td>
					<td><?= $row->user_receive_newsletter == 0 ? 'Nein' : 'Ja' ?></td>
					<td class="functions">
						<a class="btn btn-danger btn-xs load-modal" data-source="/admin/memberfunction/ban/<?= $row->member_id ?>" role="button">Sperren</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: activate, ban -->