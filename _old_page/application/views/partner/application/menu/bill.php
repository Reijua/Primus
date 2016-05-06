<div class="application-header">
	<div class="application-headline"><h3>Rechnungen</h3></div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<div class="responsive-table">
				<table class="table">
					<thead>
						<th class="text-left" style="width: 100px; min-width: 100px;">Rechnungsnr.</th>
						<th style="text-align:center; width: 100px; min-width: 100px;">Datum</th>
						<th style="text-align:center; width: 100px; min-width: 100px;">Status</th>
						<th class="text-left" style="min-width: 250px;">Adresse</th>
						<th style="width: 100px; min-width: 100px; text-align:right;">Betrag in &euro;</th>
					</thead>
					<tbody>
						<?php foreach ($this->Bill_Model->get_bill($object_account->company_id)->result() as $row) { ?>
						<tr>
							<td class="text-left" style="width: 100px; min-width: 100px;"><a href="/bill/print_bill/<?=$row->bill_year; ?><?=$row->bill_id; ?>" target="_blank"><?=$row->bill_year; ?><?=$row->bill_id; ?></a></td>
							<td class="text-center" style="width: 100px; min-width: 100px;"><?=mdate("%d.%m.%Y",mysql_to_unix($row->bill_date)); ?></td>
							<td style="text-align:center; width: 100px; min-width: 100px;"><?=$row->status_name ?></td>
							<td class="text-left" style="min-width: 250px;"><?=$row->bill_address; ?>, <?=$row->bill_pc; ?> <?=$row->bill_city; ?></td>
							<td style="width: 100px; min-width: 100px; text-align:right;"><?=$this->Bill_Model->get_sum($row->bill_year, $row->bill_id); ?> &euro;</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>