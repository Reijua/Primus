<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>
<div class="application-header">
	<div class="application-headline"><h3>Werbung</h3></div>
	<div class="application-options">
		<ul>
			<li><button class="modal" data-title="Werbung einschalten" data-type="url" data-source="/ajax/modal/create_advertisement/">Einschalten</button></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<div class="responsive-table">
				<table class="table">
					<thead>
						<th style="min-width: 250px;">Bezeichnung</th>
						<th style="width: 100px; min-width: 100px; text-align: center;">Von</th>
						<th style="width: 100px; min-width: 100px; text-align: center;">Bis</th>
						<th style="width: 140px; min-width:140px; text-align: right;">Optionen</th>
					</thead>
					<tbody>
						<?php foreach ($this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "all")->result() as $row) { ?>
						<tr>
							<td style="min-width: 250px;"><?=$row->advertisement_name ?></td>
							<td style="width: 100px; min-width: 100px; text-align: center;"><?=mdate("%d.%m.%Y",mysql_to_unix($row->advertisement_start_date)) ?></td>
							<td style="width: 100px; min-width: 100px; text-align: center;"><?=mdate("%d.%m.%Y",mysql_to_unix($row->advertisement_end_date)) ?></td>
							<td style="width: 140px; min-width:140px; text-align: right;"><span class="link modal" data-title="Werbeanzeige bearbeiten" data-type="url" data-source="/ajax/modal/edit_advertisement/<?=$row->advertisement_id ?>">Bearbeiten</span></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>