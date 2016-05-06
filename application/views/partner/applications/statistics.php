<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Profil</div>
				<div class="panel-body text-center">
				<?php

				$query = $this->Statistics->get_profile_statistics($this->session->partner['user_id']);
				$statistics = $query->first_row();

				if (!empty($statistics->company_profile_last_view)) {
					$last_view = DateTime::createFromFormat('Y-m-d H:i:s', $statistics->company_profile_last_view)->format('d.m.Y H:i');
				}

				?>

					<h1 style="margin: 0"><?= $statistics->company_profile_views ?> <?= ($statistics->company_profile_views == 1 ? 'Aufruf' : 'Aufrufe') ?></h1>

				<?php if (!empty($last_view)): ?>
					Letzter Aufruf: <?= $last_view ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Feedposts</div>
				<div class="panel-body text-center">
				<?php

				$query = $this->Statistics->get_post_statistics($this->session->partner['user_id']);
				$statistics = $query->first_row();

				if (!empty($statistics->post_last_view)) {
					$last_view = DateTime::createFromFormat('Y-m-d H:i:s', $statistics->post_last_view)->format('d.m.Y H:i');
				}

				?>

					<h1 style="margin: 0"><?= $statistics->post_views ?> <?= ($statistics->post_views == 1 ? 'Aufruf' : 'Aufrufe') ?></h1>

				<?php if (!empty($last_view)): ?>
					Letzter Aufruf: <?= $last_view ?>
				<?php endif; ?>
				</div>
				<div class="panel-footer" style="padding: 0">
					<table class="table table-condensed" style="margin: 0">
					<?php foreach ($this->Statistics->get_post_statistics_top($this->session->partner['user_id'])->result() as $i => $row): ?>
						<tr <?= ($i == 0 ? 'class="success"' : '') ?>>
							<td><?= ($i + 1) ?>.</td>
							<td style="word-break: break-all;"><?= character_limiter($row->post_title, 25) ?></td>
							<td style="text-align: right;"><?= $row->post_views ?> <?= ($row->post_views == 1 ? 'Aufruf' : 'Aufrufe') ?></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Jobangebote</div>
				<div class="panel-body text-center">
				<?php

				$query = $this->Statistics->get_job_statistics($this->session->partner['user_id']);
				$statistics = $query->first_row();

				if (!empty($statistics->job_last_view)) {
					$last_view = DateTime::createFromFormat('Y-m-d H:i:s', $statistics->job_last_view)->format('d.m.Y H:i');
				}

				?>

					<h1 style="margin: 0"><?= $statistics->job_views ?> <?= ($statistics->job_views == 1 ? 'Aufruf' : 'Aufrufe') ?></h1>

				<?php if (!empty($last_view)): ?>
					Letzter Aufruf: <?= $last_view ?>
				<?php endif; ?>
				</div>
				<div class="panel-footer" style="padding: 0">
					<table class="table table-condensed" style="margin: 0">
					<?php foreach ($this->Statistics->get_job_statistics_top($this->session->partner['user_id'])->result() as $i => $row): ?>
						<tr <?= ($i == 0 ? 'class="success"' : '') ?>>
							<td><?= ($i + 1) ?>.</td>
							<td style="word-break: break-all;"><?= character_limiter($row->job_title, 25) ?></td>
							<td style="text-align: right;"><?= $row->job_views ?> <?= ($row->job_views == 1 ? 'Aufruf' : 'Aufrufe') ?></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Werbung</div>
				<div class="panel-body text-center">
				<?php

				$query = $this->Statistics->get_advertisement_statistics($this->session->partner['user_id']);
				$statistics = $query->first_row();

				if (!empty($statistics->advertisement_last_view)) {
					$last_view = DateTime::createFromFormat('Y-m-d H:i:s', $statistics->advertisement_last_view)->format('d.m.Y H:i');
				}

				?>

					<h1 style="margin: 0"><?= $statistics->advertisement_views ?> <?= ($statistics->advertisement_views == 1 ? 'Aufruf' : 'Aufrufe') ?></h1>

				<?php if (!empty($last_view)): ?>
					Letzter Aufruf: <?= $last_view ?>
				<?php endif; ?>
				</div>
				<div class="panel-footer" style="padding: 0">
					<table class="table table-condensed" style="margin: 0">
					<?php foreach ($this->Statistics->get_advertisement_statistics_top($this->session->partner['user_id'])->result() as $i => $row): ?>
						<tr <?= ($i == 0 ? 'class="success"' : '') ?>>
							<td><?= ($i + 1) ?>.</td>
							<td style="word-break: break-all;"><?= character_limiter($row->advertisement_title, 25) ?></td>
							<td style="text-align: right;"><?= $row->advertisement_views ?> <?= ($row->advertisement_views == 1 ? 'Aufruf' : 'Aufrufe') ?></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>