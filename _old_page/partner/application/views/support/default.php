<script type="text/javascript">
$(document).ready(function(){
	$(this).tabs();
});
</script>
<?php if($this->input->cookie("partner_id") == NULL){ ?>
<div class="banner">
	<table class="banner-headline">
		<tr>
			<td><h1><span>Herzlich Willkommen!</span></h1></td>
		</tr>
	</table>
	<div class="banner-content">
		<?php
		foreach ($this->Account_Model->get_account("all")->result() as $row) {
		echo '<div class="logo-item">
				<table>
					<tr>
						<td><img src="'.$this->Account_Model->get_logo($cdn_url, $row->company_id).'" alt="'.$row->company_name.'" /></td>
					</tr>
				</table>
			  </div>';
		}
		?>
	</div>	
</div>
<?php }else{ ?>
<div class="banner" style="background-image: url(<?=$this->Account_Model->get_banner($cdn_url, $this->input->cookie("partner_id")) ?>)">
	<table class="partner-logo">
		<tr>
			<td><img src="<?=$this->Account_Model->get_logo($cdn_url, $this->input->cookie("partner_id")) ?>"></td>
		</tr>
	</table>
</div>
<?php } ?>
<div class="container">
	<div class="container-content" style="max-width:600px;">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="tabs">
				<nav>
					<ul>
						<li data-tab="tab-1">Passwort vergessen</li>
						<li data-tab="tab-2">Sonstige Probleme</li>
					</ul>
				</nav>
				<div class="content">
					<div id="tab-1">
						<form methode="post" data-url="/ajax/support/recovery_password/" data-redirect="/" data-type="normal">
							<label for="recovery_password_email">E-Mail-Adresse</label>
							<input type="email" name="email" id="recovery_password_email">
							<hr>
							<button class="submit">Senden</button>
						</form>
					</div>
					<div id="tab-2">
						<form methode="post" data-url="/ajax/support/send_problem/" data-redirect="/" data-type="normal">
							<label for="problem_name">Firmenname</label>
							<input type="text" name="name" id="problem_name">
							<table style="width: 100%; border-spacing:0; border-collapse:collapse;">
								<tr>
									<td style="width:49%; padding-right:1%;">
										<label for="problem_firstname">Vorname</label>
										<input type="text" name="firstname" id="problem_firstname">
									</td>
									<td style="width:49%; padding-left:1%;">
										<label for="problem_lastname">Nachname</label>
										<input type="text" name="lastname" id="problem_lastname">
									</td>
								</tr>
							</table>
							<label for="problem_email">E-Mail-Adresse</label>
							<input type="email" name="email" id="problem_email">
							<label for="problem_description">Beschreibung</label>
							<textarea id="problem_description" name="description" style="height:200px; max-height:250px;"></textarea>
							<hr>
							<button class="submit">Senden</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>