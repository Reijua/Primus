<style type="text/css">
#banner-preview{
	height: 150px;
	border: 1px solid #CCCCCC;
	background-color: #FFFFFF;
	text-align: center;
}
	#banner-preview img{
		height: auto;
		width: auto;
		max-height: 150px;
		max-width: 100%;
		margin: 0 auto;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '#banner-preview',
		p_format: '<img src="{0}" />'
	});
});
</script>
<form methode="post" data-type="normal" data-url="/ajax/advertisement/create_advertisement/" data-redirect="/">
	<div class="column-1">
		<div class="column-content">
			<label for="file">Banner</label>
			<div id="banner-preview">
			</div>
			<div class="file-selector">
				<input type="file" id="file" name="file">
				Banner auswählen...
			</div>
		</div>
	</div>
	<div class="column-2" style="padding-bottom:0; margin-bottom:0;">
		<div class="column-content">
			<label for="advertisement_name">Titel</label>
			<input type="text" name="name" id="advertisement_name" />
			<label>Von</label>
			<div class="responsive-table">
				<table style="width:100%; border-collapse:0; border-spacing: 0;">
					<tr>
						<td style="width:60px; min-width: 60px; padding-right:5px;">
							<div class="selectbox">
								<input type="text" name="start_date_day" id="advertisement_start_date_day" placeholder="Tag" maxlength="2">
							</div>
						</td>
						<td style="min-width: 100px;">
							<div class="select-box">
								<select name="start_date_month">
									<option value="0">Monat auswählen...</option>
									<?php
									foreach ($this->General_Model->get_month()->result() as $row) {
									echo '<option value="'.$row->month_id.'">'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
									}
									?>
								</select>
							</div>
						</td>
						<td style="width:100px; min-width: 100px;  padding-left:5px;">
							<input type="text" name="start_date_year" id="advertisement_start_date_year" placeholder="Jahr" maxlength="4">
						</td>
					</tr>
				</table>
			</div>
			<label>Bis</label>
			<div class="responsive-table">
				<table style="width:100%; border-collapse:0; border-spacing: 0;">
					<tr>
						<td style="width:60px; min-width: 60px; padding-right:5px;">
							<div class="selectbox">
								<input type="text" name="end_date_day" id="advertisement_end_date_day" placeholder="Tag" maxlength="2">
							</div>
						</td>
						<td style="min-width: 100px;">
							<div class="select-box">
								<select name="end_date_month">
									<option value="0">Monat auswählen...</option>
									<?php
									foreach ($this->General_Model->get_month()->result() as $row) {
									echo '<option value="'.$row->month_id.'">'.$this->lang->line('cal_'.strtolower($row->month_name)).'</option>';
									}
									?>
								</select>
							</div>
						</td>
						<td style="width:100px; min-width: 100px;  padding-left:5px;">
							<input type="text" name="end_date_year" id="advertisement_end_date_year" placeholder="Jahr" maxlength="4">
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="column-2" style="padding-bottom:0; margin-bottom:0;">
		<div class="column-content">
			<label for="advertisement_text">Text</label>
			<textarea style="height: 92px; max-height: 92px;" name="description" id="advertisement_description"></textarea>
			<label for="advertisement_link">Link</label>
			<input type="text" name="link" id="advertisement_link" />
		</div>
	</div>
	<div class="column-1">
		<div class="column-content" style="padding-top:0; margin-top:0;">
			<hr />
			<button class="submit">Speichern</button>
		</div>
	</div>
</form>