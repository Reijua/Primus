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
<div class="banner" style="background-image: url(<?php echo $resource_url; ?>image/banner/city.jpg);"></div>
<div class="container">
	<div class="container-content" style="max-width:450px;">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content">
				<h1 class="text-center" style="margin-bottom:20px;">Konto erstellen</h1>
				<form methode="post" data-url="/ajax/account/register_password/" data-type="normal" data-redirect="/" >
					<div class="panel-column-1">
						<div class="column-content">
							<input type="hidden" name="email" value="<?=$this->input->get("email"); ?>" />
							<input type="hidden" name="code" value="<?=$this->input->get("code"); ?>" />
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