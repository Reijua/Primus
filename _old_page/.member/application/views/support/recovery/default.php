<style type="text/css">
.panel{
	max-width: 600px;
}
@media screen and (max-width: 600px){
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
		p_min_height : 459
	});
	$(document).tabs();
});
</script>
<div class="content-wrapper">
	<div class="content-holder">
		<div class="panel" style="margin-top: -184px; margin-left: -300px;">
			<div class="panel-header">
				<h1>Probleme beim Anmelden?</h1>
			</div>
			<div class="panel-content">
				<div class="column-1">
					<div class="column-content">
						<div class="tabs">
							<nav>
								<ul>
									<li data-tab="tab-1">Passwort vergessen</li>
									<li data-tab="tab-2">Sonstige Probleme</li>
								</ul>
							</nav>
							<div class="content">
								<div id="tab-1">
									<form methode="post" data-url="/ajax/account/support/password_recovery/" data-redirect="/" data-type="normal">
										<label for="recovery_password_email">E-Mail-Adresse</label>
										<input type="email" name="email" id="recovery_password_email">
										<hr color="#CCCCCC">
										<button class="submit">Senden</button>
									</form>
								</div>
								<div id="tab-2">
									<form methode="post" data-url="/ajax/account/support/other_problem/" data-redirect="/" data-type="normal">
										<label for="problem_other_email">E-Mail-Adresse</label>
										<input type="email" name="email" id="problem_other_email">
										<label for="problem_other_description">Problembeschreibung</label>
										<textarea style="height:100px; max-height:100px;" name="description" id="problem_other_description"></textarea>
										<hr color="#CCCCCC">
										<button class="submit">Senden</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>