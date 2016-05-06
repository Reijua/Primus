<div class="container partner-feed">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/admin/news/create-news">News erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Titel</th>
				<th>Text</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->News->get_news('all')->result() as $i => $row): ?>

				<tr>
					<td><?= $row->news_id ?></td>
					<td><?= $row->news_title ?></td>
					<td><?= word_limiter($row->news_text, 30) ?></td>
					<td class="functions">
						<a class="btn btn-danger btn-xs load-modal" data-source="/admin/news/delete-news/<?= $row->news_id ?>" role="button">Löschen</a>
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/news/edit-news/<?= $row->news_id ?>" role="button">Bearbeiten</a>
						<a class="btn btn-success btn-xs" href="/admin/news/upload-images/<?= $row->news_id ?>" role="button">Bilder hinzufügen</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: activate, ban -->