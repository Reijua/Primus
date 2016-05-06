<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
});
</script>
<div class="column-1" style="width:100%; height:100%; overflow: auto;">
	<form methode="post" data-type="normal" data-url="/ajax/event/update_event/" data-redirect="/">
		<div class="column-2">
			<div class="column-content">
				<input type="hidden" name="id" value="<?php echo $object_event->event_id; ?>">
				<label for="event_name">Name</label>
				<input type="text" name="name" id="event_name" value="<?=$object_event->event_name; ?>">
				<label>Kontaktperson</label>
				<div class="select-box">
					<select name="leader">
						<option value="0">Verantwortlichen auswählen...</option>
						<?php
						$leader = array_merge($this->Account_Model->get_account("group", "honorary member")->result(), $this->Account_Model->get_account("group", "management")->result());
						foreach ($leader as $row) {
							echo '<option value="'.$row->member_id.'" '.($object_event->leader_id != $row->member_id ? '' : 'selected="selected"').'>'.$row->member_firstname.' '.$row->member_lastname.'</option>';
						}
						?>
					</select>
				</div>
				<label>Typ</label>
				<div class="select-box">
					<select name="type">
						<option value="0">Typ auswählen...</option>
						<?php
						foreach ($this->Event_Model->get_category()->result() as $row) {
							echo '<option value="'.$row->type_id.'" '.($object_event->type_id != $row->type_id ? '' : 'selected="selected"').'>'.$row->type_name.'</option>';
						}
						?>
					</select>
				</div>
				<label>Datum</label>
				<table style="width:100%; border-collapse:0; border-spacing: 0;">
					<tr>
						<td style="width:60px; min-width: 60px; padding-right:5px;">
							<div class="selectbox">
								<input type="text" name="day" id="event_day" placeholder="Tag" maxlength="2" value="<?php echo mdate("%d", mysql_to_unix($object_event->event_start_date)); ?>">
							</div>
						</td>
						<td style="min-width: 100px;">
							<div class="select-box">
								<select name="month">
									<option value="0">Monat auswählen...</option>
									<?php
									foreach ($this->General_Model->get_month()->result() as $row) {
									echo '<option value="'.$row->month_id.'" '.(mdate("%m", mysql_to_unix($object_event->event_start_date)) != $row->month_id ? '' : 'selected="selected"').'>'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
									}
									?>
								</select>
							</div>
						</td>
						<td style="width:100px; min-width: 100px;  padding-left:5px;">
							<input type="text" name="year" id="event_year" placeholder="Jahr" maxlength="4" value="<?php echo mdate("%Y", mysql_to_unix($object_event->event_start_date)); ?>">
						</td>
					</tr>
				</table>
				<table style="width:100%; border-collapse:0; border-spacing: 0;">
					<tr>
						<td style="width: 49%; padding-right: 1%;">
							<label>Uhrzeit</label>
							<table style="width:100%; border-collapse:0; border-spacing: 0;">
								<tr>
									<td style="width: 50px;"><input type="text" name="hour" id="event_hour" maxlength="2" value="<?php echo mdate("%H",mysql_to_unix($object_event->event_start_date)); ?>" /></td>
									<td style="width: 5px;">:</td>
									<td style="width: 50px;"><input type="text" name="minute" id="event_minute" maxlength="2" value="<?php echo mdate("%i",mysql_to_unix($object_event->event_start_date)); ?>" /></td>
									<td style="min-width: 30px">Uhr</td>
								</tr>
							</table>
						</td>
						<td style="width: 49%; padding-left: 1%;">
							<label>Gesamtanzahl der Plätze</label>
							<input type="text" name="amount" id="event_amount" value="<?=$object_event->event_amount_member; ?>" />
						</td>
					</tr>
				</table>
				
				<label for="event_address">Adresse</label>
				<input type="text" name="address" id="event_address" value="<?=$object_event->event_address; ?>">
				<table style="width:100%; border-collapse:0; border-spacing: 0;">
					<tr>
						<td style="width: 29%; padding-right: 1%;">
							<label for="event_pc">PLZ</label>
							<input type="text" name="pc" id="event_pc" value="<?=$object_event->event_pc; ?>">
						</td>
						<td style="width: 69%;  padding-left: 1%;">
							<label for="event_city">Ort</label>
							<input type="text" name="city" id="event_city" value="<?=$object_event->event_city; ?>">
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label for="event_description">Information</label>
				<textarea name="description" id="event_description" style="height: 376px; max-height:376px;"><?=$object_event->event_description; ?></textarea>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content"><button class="submit">Bearbeiten</button></div>
		</div>
	</form>
</div>