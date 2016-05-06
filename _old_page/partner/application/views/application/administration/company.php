<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
	$(this).modal();
	$("#filter-company-group").change(function(){
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
	});
});
</script>
<div class="application-header">
	<div class="application-headline">Partner</div>
	<div class="application-option">
		<ul>
			<li><span class="modal link" data-title="Partner anlegen" data-type="url" data-source="/ajax/modal/create_partner/">Partner anlegen</span></li>
			<li>
				Pakete: 
				<select id="filter-company-group">
					<option value="0">Alle</option>
					<?php
					foreach ($this->Partner_Model->get_group()->result() as $row) {
					echo '<option value="'.$row->group_id.'">'.$row->group_name.'</option>';
					}
					?>
				</select>
			</li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="responsive-table">
		<table class="table" id="company-table">
			<thead>
				<tr>
					<th style="width: 200px; min-width: 200px;">Name</th>
					<th style="width: 100px; min-width: 100px; text-align:center;">Paket</th>
					<th style="width: 200px; min-width: 200px; text-align:center;">E-Mail-Adresse</th>
					<th style="width: 130px; min-width: 130px; text-align:center;">Status</th>
					<th style="width: 130px; min-width: 130px; text-align:center;">Letze Anmeldung</th>
					<th style="min-width: 170px;">Optionen</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($this->Partner_Model->get_partner("all")->result() as $row) {
				echo '<tr data-group="'.$row->group_id.'">
						<td style="width: 200px; min-width: 200px;">'.$row->company_name.'</td>
						<td style="width: 100px; min-width: 100px; text-align:center;">'.$row->group_name.'</td>
						<td style="width: 200px; min-width: 200px;">'.$row->company_email.'</td>
						<td style="width: 130px; min-width: 130px; text-align:center;">'.$row->status_name.'</td>
						<td style="width: 130px; min-width: 130px; text-align:center;">'.mdate('%j.%m.%Y, %H:%i Uhr',mysql_to_unix($row->company_last_login)).'</td>
						<td style="min-width: 170px;">
							<table>
								<tr>
									<td style="width:50%;"><span class="link modal" data-title="'.$row->company_name.'" data-type="url" data-source="/ajax/modal/edit_partner/'.$row->company_id.'/">Bearbeiten</span></td>
									<td style="width:50%;">'.($this->Partner_Model->is_locked($row->company_id)->num_rows() == 1 ? '<form methode="post" data-type="confirm" data-text="Wollen Sie diesen Benutzer wirklich entsperren?" data-url="/ajax/member/unlock_partner/'.$row->company_id.'" data-redirect="/"><span class="link submit">Freischalten</span></form>' : '<form methode="post" data-type="prompt" data-text="Warum wird das Mitglied gesperrt?" data-url="/ajax/member/lock_partner/'.$row->company_id.'" data-redirect="/"><span class="link submit">Sperren</span></form>' ).'</td>
								</tr>
							</table>
						</td>
					  </tr>';
				}

				/**/
				?>
			</tbody>			
		</table>
	</div>
</div>