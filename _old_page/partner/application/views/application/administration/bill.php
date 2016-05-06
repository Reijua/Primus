<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
	$(this).modal();
	/*$("#filter-company-group").change(function(){
		if($(this).val() != 0){
			v_val = $(this).val();
			$("#company-table").children("tbody").children("tr").each(function(){
				if($(this).attr("data-group") == v_val){
					if($(this).is(":hidden")){
						$(this).delay(500).fadeIn(500);
					}
				}else{
					if($(this).is(":visible")){
						$(this).fadeOut(500);
					}
				}
			});
		}else{
			$("#company-table").children("tbody").children(":hidden").fadeIn(500);
		}
	});*/
});
</script>
<div class="application-header">
	<div class="application-headline">Rechnungen</div>
	<div class="application-option">
		<ul>
			<li><span class="modal link" data-title="Rechnung anlegen" data-type="url" data-source="/ajax/modal/create_bill/">Rechnung anlegen</span></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="responsive-table">
		<table class="table" id="company-table">
			<thead>
				<tr>
					<th style="width: 100px; min-width: 100px;">Rechnungsnr.</th>
					<th style="width: 100px; min-width: 100px; text-align:center;">Datum</th>
					<th style="width: 250px; min-width: 250px; text-align:center;">Empfänger</th>
					<th style="width: 100px; min-width: 100px; text-align:center;">Status</th>
					<th style="width: 130px; min-width: 130px; text-align:right;">Summe</th>
					<th style="min-width: 170px;">Optionen</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($this->Bill_Model->get_bill()->result() as $row) {
				echo '<tr data-group="'.$row->bill_year.'">
						<td style="width: 100px; min-width: 100px;">'.$row->bill_year.''.$row->bill_id.'</td>
						<td style="width: 100px; min-width: 100px; text-align:center;">'.mdate('%j.%m.%Y',mysql_to_unix($row->bill_date)).'</td>
						<td style="width: 250px; min-width: 250px; text-align:center;">'.$row->company_name.'</td>
						<td style="width: 100px; min-width: 100px; text-align:center;">'.$row->status_name.'</td>
						<td style="width: 130px; min-width: 130px; text-align:right;">'.number_format($this->Bill_Model->get_sum($row->bill_year, $row->bill_id),2,',','.').' &euro;</td>
						<td style="min-width: 170px;">
							<table>
								<tr>
									<td style="width:50%;"><span class="link modal" data-title="Nr. '.$row->bill_year.''.$row->bill_id.'" data-type="url" data-source="/ajax/modal/edit_bill/'.$row->bill_year.''.$row->bill_id.'/">Bearbeiten</span></td>
									<td style="width:50%;"></td>
								</tr>
							</table>
						</td>
					  </tr>';
				}
				
				?>
			</tbody>			
		</table>
	</div>
</div>