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
		p_min_height : 320
	});	
});
</script>
<div class="content-wrapper">
	<div class="content-holder">
		<div class="panel" style="margin-top: -160px; margin-left: -200px;">
			<div class="panel-header">
				<h1>Konto erstellen</h1>
			</div>
			<div class="panel-content">
				<form methode="post" data-url="/ajax/account/signup_password/" data-type="normal" data-redirect="/" >
					<div class="panel-column-1">
						<div class="column-content">
							<input type="hidden" name="email" value="<?=$this->input->get_post("email"); ?>" />
							<input type="hidden" name="code" value="<?=$this->input->get_post("code"); ?>" />
							<label>Passwort</label>
							<input type="password" name="password" id="signup_password">
							<label>Passwort bestätigen</label>
							<input type="password" name="password_confirm" id="signup_password_confirm">
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