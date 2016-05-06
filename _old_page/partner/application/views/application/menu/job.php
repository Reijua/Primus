<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>
<div class="application-header">
	<div class="application-headline"><h3>Jobangebote</h3></div>
	<div class="application-options">
		<ul>
			<li><button class="modal" data-title="Jobangebot erstellen" data-type="url" data-source="/ajax/modal/create_job/">Hinzufügen</button></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<div class="responsive-table">
				<table class="table">
					<thead>
						<tr>
							<th style="min-width: 250px;">Bezeichnung</th>
							<th style="width: 120px; min-width: 120px; text-align:center;">Veröffentlicht am</th>
							<th style="width: 90px; min-width: 90px; text-align:center;">Views</th>
							<th style="width: 140px; min-width: 140px;">Optionen</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "filter:open")->result() as $row) { ?>
						<tr>
							<td><a href="/job/details/<?=$row->job_id ?>/" target="_blank"><?=$row->job_title ?></a></td>
							<td style="width: 120px; min-width: 120px; text-align:center;"><?=mdate("%d.%m.%Y",mysql_to_unix($row->job_release_date))?></td>
							<td style="width: 90px; min-width: 90px; text-align:center;"><?=$row->job_views ?></td>
							<td><form method="post" data-url="/ajax/job/close_job/<?=$row->job_id ?>" data-type="confirm" data-text="Wollen Sie das Jobangebot '<?=$row->job_title ?>' wirklich schließen?" data-redirect="/"><span class="link modal" data-title="Jobangebot bearbeiten" data-type="url" data-source="/ajax/modal/edit_job/<?=$row->job_id?>">Bearbeiten</span> | <span class="link submit">Schließen</span></form></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="column-1">
		<div class="column-content">
			<h5>Bereits vergebene Jobs</h5><br />
			<table class="table">
				<thead>
					<tr>
						<th style="min-width: 250px;">Bezeichnung</th>
						<th style="width: 120px; min-width: 120px; text-align:center;">Geschlossen am</th>
						<th style="width: 90px; min-width: 90px; text-align:center;">Views</th>
						<th style="width: 140px; min-width: 140px;">Optionen</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "filter:closed")->result() as $row) { ?>
					<tr>
						<td><?=$row->job_title ?></td>
						<td style="width: 120px; min-width: 120px; text-align:center;"><?=mdate("%d.%m.%Y",mysql_to_unix($row->job_close_date))?></td>
						<td style="width: 90px; min-width: 90px; text-align:center;"><?=$row->job_views ?></td>
						<td><?php if(mysql_to_unix($row->job_close_date) < time() && time() < (mysql_to_unix($row->job_close_date)+1800)){ ?><form method="post" data-url="/ajax/job/open_job/<?=$row->job_id ?>/" data-type="normal" data-redirect="/"><span class="link submit">Öffnen</span></form><?php }else{ ?> - <?php } ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
