<div class="container partner-jobs">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/partner/jobs/create-job">Jobangebot erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Eintrittsdatum</th>
				<th>Titel</th>
				<th>Anstellungsart</th>
				<th>Standort</th>
				<th>Kontaktperson</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Job->get_job('filter:company', $this->session->partner['user_id'])->result() as $i => $row): ?>

				<tr>
					<td><?= $i + 1 ?></td>
					<td><?= date('d.m.Y', strtotime($row->job_start_date)) ?></td>
					<td><a href='/job/details/<?= $row->job_id ?>' target="_blank"><?= $row->job_title ?></a></td>
					<td><?= $row->type_name ?></td>
					<td><?= $row->address_city ?>, <?= $row->country_name ?></td>
					<td><?= $row->employee_title ?> <?= $row->employee_firstname ?> <?= $row->employee_lastname ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/partner/jobs/edit-job/<?= $row->job_id ?>" role="button">Jobangebot bearbeiten</a>
						<?php if ($row->job_open == 0): // Job is closed ?>
						<a class="btn btn-success btn-xs load-modal" data-source="/partner/jobs/toggle-job/<?= $row->job_id ?>" role="button">Jobangebot öffnen</a>
						<?php else: // Job is open ?>
						<a class="btn btn-danger btn-xs load-modal" data-source="/partner/jobs/toggle-job/<?= $row->job_id ?>" role="button">Jobangebot schließen</a>
						<?php endif; ?>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>