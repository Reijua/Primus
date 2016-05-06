<div class="container partner-feed">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/admin/partnerfunction/create-partner">Partner erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Registrierd.</th>
				<th>E-Mail</th>
				<th>Name</th>
				<th>Kontakt-Mail</th>
				<th>Paket</th>
				<th>Newsletter</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Admin->get_all_partner()->result() as $i => $row): ?>
				
				<tr>
					<td><a href="<?= base_url() . 'profile/partner/' . $row->user_id ?>"><?= $row->user_id ?></a></td>
					<td><?= date('d.m.Y', strtotime($row->user_registration_date)) ?></td>
					<td><?= $row->user_email ?></td>
					<td><?= $row->company_name ?></td>
					<td><?= $row->company_contact_email ?></td>
					<td><?= $row->companypacket_description ?></td>
					<td><?= $row->user_receive_newsletter == 0 ? 'Nein' : 'Ja' ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/partnerfunction/edit-partner/<?= $row->user_id ?>" role="button">Bearbeiten</a>
						<a class="btn btn-danger btn-xs load-modal" data-source="/admin/partnerfunction/delete-partner/<?= $row->user_id ?>" role="button">Löschen</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: create and edit application, delete and edit model functions, new admin user, method or button to send -->