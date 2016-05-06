<div class="container partner-feed">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/partner/feed/create-post">Post erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Datum</th>
				<th>Titel</th>
				<th>Kurztext</th>
				<th>Autor</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Feed->get_post('filter:company', $this->session->partner['user_id'])->result() as $i => $row): ?>

				<tr>
					<td><?= $i + 1 ?></td>
					<td><?= date('d.m.Y', strtotime($row->post_date_added)) ?></td>
					<td><?= nl2br($row->post_title) ?></td>
					<td><?= word_limiter(nl2br($row->post_text), 30) ?></td>
					<td><?= $this->User->get_user_name($row->author_id) ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/partner/feed/edit-post/<?= $row->post_id ?>" role="button">Post bearbeiten</a>
						<a class="btn btn-danger btn-xs load-modal" data-source="/partner/feed/delete-post/<?= $row->post_id ?>" role="button">Post löschen</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>