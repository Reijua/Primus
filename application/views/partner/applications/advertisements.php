<div class="container partner-advertisements">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/partner/advertisements/create-advertisement">Werbung schalten</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Geschaltet von</th>
				<th>Geschaltet bis</th>
				<th>Titel</th>
				<th>Link</th>
				<th>Text</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Advertisement->get_advertisement('filter:company', $this->session->partner['user_id'])->result() as $i => $row): ?>

				<tr>
					<td><?= $i + 1 ?></td>
					<td><?= date('d.m.Y', strtotime($row->advertisement_start_date)) ?></td>
					<td><?= date('d.m.Y', strtotime($row->advertisement_end_date)) ?></td>
					<td><?= $row->advertisement_title ?></td>
					<td><a href='<?= $row->advertisement_url ?>' target="_blank"><?= $row->advertisement_url_text ?></a></td>
					<td><?= nl2br($row->advertisement_text) ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/partner/advertisements/edit-advertisement/<?= $row->advertisement_id ?>" role="button">Werbung bearbeiten</a>
						<?php if ($row->advertisement_enabled == 0): // Advertisement is disabled ?>
						<a class="btn btn-success btn-xs load-modal" data-source="/partner/advertisements/toggle-advertisement/<?= $row->advertisement_id ?>" role="button">Werbung aktivieren</a>
						<?php else: // Advertisement is enabled ?>
						<a class="btn btn-danger btn-xs load-modal" data-source="/partner/advertisements/toggle-advertisement/<?= $row->advertisement_id ?>" role="button">Werbung deaktivieren</a>
						<?php endif; ?>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>