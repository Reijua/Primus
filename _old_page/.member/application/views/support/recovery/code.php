<style type="text/css">
.panel{
	max-width: 550px;
}
@media screen and (max-width: 550px){
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
		p_min_height : 300
	});
	$(document).tabs();
});
</script>
<div class="content-wrapper">
	<div class="content-holder">
		<div class="panel" style="margin-top: -150px; margin-left: -275px;">
			<div class="panel-header">
				<h1>Passwort wiederherstellen</h1>
			</div>
			<div class="panel-content">
				<div class="column-1">
					<div class="column-content">
						<form methode="post" data-url="/ajax/account/recovery/" data-redirect="/" data-type="normal">
							<input type="hidden" value="<?php echo $this->input->get_post("code"); ?>" name="code">
							<input type="hidden" value="<?php echo $this->input->get_post("email"); ?>" name="email">
							<label for="recovery_password">Neues Passwort</label>
							<input type="password" name="password" id="recovery_password">
							<label for="recovery_confirm_password">Passwort bestätigen</label>
							<input type="password" name="confirm_password" id="recovery_confirm_password">
							<hr color="#CCCCCC">
							<button class="submit">Passwort ändern</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>