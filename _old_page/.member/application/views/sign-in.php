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
		p_min_height : 466
	});	
});
</script>
<div class="content-wrapper">
	<div class="content-holder">
		<div class="panel" style="margin-top: -231px; margin-left: -200px;">
			<div class="panel-header">
				<h1>Anmelden</h1>
			</div>
			<div class="panel-content">
				<form methode="post" data-url="/ajax/account/signin/" data-redirect="/" data-type="normal">
					<div class="panel-column-1 circle-image">
						<img src="<?php echo ($this->input->cookie("account_id") == NULL ? $resource_url.'image/profile/picture/male.png' : $this->Account_Model->get_profile_picture($resource_url, $this->input->cookie("account_id"), 2)) ?>" alt="Profilbild" class="large" />
					</div>
					<div class="panel-column-1">
						<div class="column-content">
							<label for="signin_username">E-Mail-Adresse</label>
							<input type="email" name="username" id="signin_username" <?php echo ($this->input->cookie("account_id") != NULL ? 'value="'.$object_account->member_email.'"' : '' ) ?>>
							<label for="signin_password">Passwort</label>
							<input type="password" name="password" id="signin_password">
						</div>
					</div>
					<div class="panel-column-1">
						<div class="column-content" style="margin-top:0; padding-top: 0; padding-bottom: 0; margin-bottom:0;">
							<hr color="#CCCCCC" style="margin:0; padding:0;" />
						</div>
					</div>
					<div class="panel-column-1">
						<div class="column-content">
							<table style="border-spacing:0; border-collapse:0; width:100%; margin-bottom: 10px;">
								<tr>
									<td class="text-left"><input type="checkbox" value="1"<?php echo ($this->input->cookie("account_id") != NULL ? ' checked="checked" ' : '' ) ?>name="email_save" id="signin_email_save"> <label for="signin_email_save" style="font-weight:300; font-size: 13px;">E-Mail-Adresse merken</label></td>
									<td class="text-right"><a href="/support/recovery/">Brauchen Sie Hilfe?</a></td>
								</tr>
							</table>
							<button class="submit">Anmelden</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
