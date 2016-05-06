<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
});
</script>
<div class="column-1" style="width:100%; height:100%; overflow: auto;">
	<form methode="post" data-type="normal" data-url="/ajax/member/update_member/" data-redirect="/">
	<div class="column-2">
		<div class="column-content">
			<table style="width:100%; border-collapse:0; border-spacing:0;">
				<tr>
					<td style="width:49%; padding-right:1%;">
						<input type="hidden" name="id" value="<?php echo $object_member->member_id; ?>" />
						<label>Anrede</label>
						<div class="select-box">
							<select name="salutation">
								<option>Anrede auswählen...</option>
								<?php
								foreach ($array_salutation as $row) {
									echo '<option value="'.$row->gender_id.'" '.($row->gender_id == $object_member->gender_id ? 'selected="selected" ' : '' ).'>'.$this->lang->line("gender_title_".$row->gender_description).'</option>';
								}
								?>
							</select>
						</div>
					</td>
					<td style="width:49%; padding-left:1%;">
						<label for="member_title">Titel</label>
						<input type="text" name="title" id="member_title" value="<?php echo $object_member->member_title; ?>" />
					</td>
				</tr>
			</table>
			<label for="member_firstname">Vorname</label>
			<input type="text" name="firstname" id="member_firstname" value="<?php echo $object_member->member_firstname; ?>" />
			<label for="member_lastname">Nachname</label>
			<input type="text" name="lastname" id="member_lastname" value="<?php echo $object_member->member_lastname; ?>" />
			<label>E-Mail-Adresse</label>
			<input type="text" readonly="readonly" name="email" id="member_email" value="<?php echo $object_member->member_email; ?>" />
			<label>Geburtstag</label>
			<table style="width:100%; border-collapse:0; border-spacing: 0;">
				<tr>
					<td style="width:60px; min-width: 60px; padding-right:5px;">
						<div class="selectbox">
							<input type="text" name="birthday_day" id="member_birthday_day" placeholder="Tag" maxlength="2" value="<?php echo mdate("%d",mysql_to_unix($object_member->member_birthday)); ?>">
						</div>
					</td>
					<td style="min-width: 150px;">
						<div class="select-box">
							<select name="birthday_month">
								<option value="0">Monat auswählen...</option>
								<?php
								foreach ($this->General_Model->get_month()->result() as $row) {
								echo '<option value="'.$row->month_id.'" '.( mdate("%m",mysql_to_unix($object_member->member_birthday)) != $row->month_id ? "" : 'selected="selected"' ).'>'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
								}
								?>
							</select>
						</div>
					</td>
					<td style="width:100px; min-width: 100px;  padding-left:5px;">
						<input type="text" name="birthday_year" id="member_birthday_year" placeholder="Jahr" maxlength="4" value="<?php echo mdate("%Y",mysql_to_unix($object_member->member_birthday)); ?>">
					</td>
				</tr>
			</table>
			<table style="width:100%; border-collapse:0; border-spacing:0;">
				<tr>
					<td style="width: 49%; padding-right: 1%;">
						<label>Klasse</label>
						<div class="select-box">
							<select name="class">
								<?php
								foreach ($array_class as $row) {
								echo '<option value="'.$row->class_id.'" '.( $row->class_id != $object_member->class_id ? '' : 'selected="selected"').'>'.$row->class_name.'</option>';
								}
								?>
							</select>
						</div>
					</td>
					<td style="width: 49%; padding-left: 1%;">
						<label>Gruppe</label>
						<div class="select-box">
							<select name="group">
								<option value="0">Gruppe auswählen...</option>
								<?php
								foreach ($array_group as $row) {
								echo '<option value="'.$row->group_id.'" '.( $row->group_id != $object_member->group_id ? '' : 'selected="selected"').'>'.$this->lang->line('group_'.strtolower(str_replace(" ", "_", $row->group_name))).'</option>';
								}
								?>
							</select>
						</div>
					</td>
				</tr>
			</table>
			<hr color="#CCCCCC" />
			<button class="submit">Bearbeiten</button>
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
		</div>
	</div>
	</form>
</div>