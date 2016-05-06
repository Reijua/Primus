<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
	$(this).modal();
	$("#filter-member-group").change(function(){
		if($(this).val() != 0){
			v_val = $(this).val();
			$("#member-table").children("tbody").children("tr").each(function(){
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
			$("#member-table").children("tbody").children(":hidden").fadeIn(500);
		}
	});
});
</script>
<div class="application-header">
	<div class="application-headline">Mitglieder</div>
	<div class="application-option">
		<ul>
			<li>
				Gruppe: 
				<select id="filter-member-group">
					<option value="0">Alle</option>
					<?php
					foreach ($this->Account_Model->get_group()->result() as $row) {
					echo '<option value="'.$row->group_id.'">'.$this->lang->line('group_'.strtolower(str_replace(" ", "_", $row->group_name))).'</option>';
					}
					?>
				</select>
			</li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="responsive-table">
		<table class="table" id="member-table">
			<thead>
				<tr>
					<th style="width: 130px; min-width: 130px;">Vorname</td>
					<th style="width: 150px; min-width: 150px;">Nachname</td>
					<th style="width: 100px; min-width: 100px; text-align:center;">Geburtstag</td>
					<th style="width: 130px; min-width: 130px; text-align:center;">Jahrgang</td>
					<th style="width: 130px; min-width: 130px; text-align:center;">Gruppe</td>
					<th style="min-width: 170px;">Optionen</td>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($this->Account_Model->get_account("all")->result() as $row) {
				echo '<tr data-group="'.$row->group_id.'">
						<td style="width: 130px; min-width: 130px;">'.$row->member_firstname.'</td>
						<td style="width: 150px; min-width: 150px;">'.$row->member_lastname.'</td>
						<td style="width: 100px; min-width: 100px; text-align:center;">'.mdate('%j.%m.%Y',mysql_to_unix($row->member_birthday)).'</td>
						<td style="width: 130px; min-width: 130px; text-align:center;">'.$row->class_name.'</td>
						<td style="width: 130px; min-width: 130px; text-align:center;">'.$this->lang->line('group_'.strtolower(str_replace(" ", "_", $row->group_name))).'</td>
						<td style="min-width: 170px;">
							<table>
								<tr>
									<td style="width:50%;"><span class="link modal" data-title="'.$row->member_firstname.' '.$row->member_lastname.'" data-type="url" data-source="/ajax/modal/edit_member/'.$row->member_id.'/">Bearbeiten</span></td>
									<td style="width:50%;">'.($this->Account_Model->is_locked($row->member_id)->num_rows() == 1 ? '<form methode="post" data-type="confirm" data-text="Wollen Sie diesen Benutzer wirklich entsperren?" data-url="/ajax/member/unlock_member/'.$row->member_id.'" data-redirect="/"><span class="link submit">Freischalten</span></form>' : '<form methode="post" data-type="prompt" data-text="Warum wird das Mitglied gesperrt?" data-url="/ajax/member/lock_member/'.$row->member_id.'" data-redirect="/"><span class="link submit">Sperren</span></form>' ).'</td>
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