<div class="container partner-feed">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/admin/event/create-event">Event erstellen</a>
		<a class="btn btn-default load-modal" role="button" data-source="/admin/event/create-eventtype">EventType erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Beschreibung</th>
				<th>Beginn</th>
				<th>Ende</th>
				<th>Verantwortlicher</th>
				<th>Art</th>
				<th>Ort</th>
				<th>Teilnehmer</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Event->get_events()->result() as $i => $row): ?>

				<tr>
					<td><?= $row->event_id ?></td>
					<td><?= $row->event_name ?></td>
					<td><?= word_limiter($row->event_description, 30) ?></td>
					<td><?= date('d.m.Y H:i', strtotime($row->event_start_date)) ?></td>
					<td><?= date('d.m.Y H:i', strtotime($row->event_end_date)) == '01.01.1970 01:00' ? 'nicht gesetzt' : date('d.m.Y H:i', strtotime($row->event_end_date)) ?></td>
					<td><?= $this->Member->get_member('filter:id', $row->leader_id)->first_row()->member_firstname .' '. $this->Member->get_member('filter:id', $row->leader_id)->first_row()->member_lastname ?></td>
					<td><?= $row->eventtype_name ?></td>
					<td><?= $row->address_street.'<br/>'.$row->address_zipcode.' '.$row->address_city ?></td>
					<td><?= $this->Event->get_participants($row->event_id)->num_rows() ?> / <?= $row->event_max_member ?></td>
					<td class="functions">
						<a class="btn btn-danger btn-xs load-modal" data-source="/admin/event/delete-event/<?= $row->event_id ?>" role="button">Löschen</a>
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/event/edit-event/<?= $row->event_id  ?>" role="button">Bearbeiten</a>
						<a class="btn btn-success btn-xs load-modal" data-source="/admin/event/show-member/<?= $row->event_id  ?>" role="button">Teilnehmer anzeigen</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: activate, ban -->