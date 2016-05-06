<div class="column-1">
	<div class="column-content">
		<h4>Ausbildung</h4>
	</div>
</div>
<div class="dynamic-fields">
	<div class="column-2" class="field">
		<div class="column-content">
			<label>Name</label>
			<input type="text">
			<label>Abteilung</label>
			<input type="text">
			<table style="width:100%; border-spacing:0; border-collapse:0;">
				<tr>
					<td style="width: 49%; padding-right:1%;">
						<label>Von</label>
						<table style="width:100%; border-spacing:0; border-collpase:0;">
							<tr>
								<td style="width:69%; padding-right: 1%;">
									<div class="select-box">
										<select>
											<option>Monat auswählen...</option>
											<?php
											foreach ($this->General_Model->get_month()->result() as $row) {
												echo '<option value="'.$row->month_id.'">'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
											}
											?>
										</select>
									</div>
								</td>
								<td style="width:29%; padding-left: 1%;">
									<input type="text" maxlength="4" placeholder="Jahr">
								</td>
							</tr>
						</table>
					</td>
					<td style="width: 49%; padding-left:1%;">
						<label>Bis</label>
						<table style="width:100%; border-spacing:0; border-collapse:0;">
							<tr>
								<td style="width:69%; padding-right: 1%;">
									<div class="select-box">
										<select>
											<option>Monat auswählen...</option>
											<?php
											foreach ($this->General_Model->get_month()->result() as $row) {
												echo '<option value="'.$row->month_id.'">'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
											}
											?>
										</select>
									</div>
								</td>
								<td style="width:29%; padding-left: 1%;">
									<input type="text" maxlength="4" placeholder="Jahr">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<label>Beschreibung</label>
			<textarea style="max-height:59px; height:59px;"></textarea>
			<div class="text-right">
				<span class="link">Entfernen</span>
			</div>			
		</div>
	</div>
	<div class="column-2" class="field">
		<div class="column-content text-center">
			<div class="field" style="border: 3px dashed #CCCCCC; height:260px;">
				<table style="width: 100%; height:100%;">
					<tr>
						<td>
							<div class="icon squared">
								<img src="<?php echo $resource_url; ?>image/icon/grey/education.png" style="height:100px; width: 100px;" />
							</div>
							<br />
							Weitere Ausbildung hinzufügen.
						</td>
					</tr>
				</table>
				
			</div>			
		</div>
	</div>
</div>