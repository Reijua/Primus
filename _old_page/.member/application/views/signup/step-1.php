
<?php 

?>


<style type="text/css">
.panel{
	max-width: 400px;
}
@media screen and (max-width: 400px){
	.panel{
		position: absolute;
		top: 0 !important;
		left: 0 !important;
		margin: 0 !important;
		padding: 0;
		width: 100%;
		display: block;
		background-color: #FFFFFF;
	}
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).initComponents({
		p_min_height : 462
	});	
});
</script>
<div class="content-wrapper">
	<div class="content-holder">
		<div class="panel" style="margin-top: -221px; margin-left: -200px;">
			<div class="panel-header">
				<h1>Konto erstellen</h1>
			</div>
			<div class="panel-content">
				<form methode="post" data-url="/ajax/account/signup/" data-redirect="/" data-type="normal">
					<div class="panel-column-1">
						<div class="column-content">
							<table style="width:100%;">
								<tr>
									<td style="width:49%; padding-right: 1%;">
										<label>Anrede</label>
										<div class="select-box">
											<select name="salutation">
												<option value="0">Auswählen...</option>
												<?php
												foreach ($this->General_Model->get_gender()->result() as $row) {
												echo '<option value="'.$row->gender_id.'">'.$this->lang->line('gender_title_'.strtolower($row->gender_description)).'</option>';
												}
												?>
											</select>
										</div>
									</td>
									<td style="width:49%; padding-left: 1%;">
										<label for="signup_title">Titel</label>
										<input type="text" name="title" id="signup_title" />
									</td>
								</tr>
							</table>
							<label for="signup_firstname">Vorname</label>
							<input type="text" name="firstname" id="signup_firstname">
							<label for="signup_lastname">Nachname</label>
							<input type="text" name="lastname" id="signup_lastname">
							<label>Geburtsdatum</label>
							<div class="responsive-table">
							<table style="width:100%; border-collapse:0; border-spacing: 0;">
								<tr>
									<td style="width:60px; min-width: 60px; padding-right:5px;">
										<div class="selectbox">
											<input type="text" name="birthday_day" id="signup_birthday_day" placeholder="Tag" maxlength="2">
										</div>
									</td>
									<td style="min-width: 100px;">
										<div class="select-box">
											<select name="birthday_month">
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
										<input type="text" name="birthday_year" id="signup_birthday_year" placeholder="Jahr" maxlength="4">
									</td>
								</tr>
							</table>
							</div>
							<label for="signup_email">E-Mail-Adresse</label>
							<input type="email" name="email" id="signup_email">
						</div>
					</div>
					<div class="panel-column-1">
						<div class="column-content" style="margin-top:0; padding-top: 0; padding-bottom: 0; margin-bottom:0;">
							<hr color="#CCCCCC" style="margin:0; padding:0;" />
						</div>
					</div>
					<div class="panel-column-1">
						<div class="column-content">
							<button class="submit">Registrieren</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>