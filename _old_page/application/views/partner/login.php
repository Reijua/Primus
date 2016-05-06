<?php 
		//$password = $this->P_account_model->password_hash("info@nitec.at", "asdf");
$cdn_url = 'http://primus-romulus.net/resource/'; // TODO nur Vorübergehend!!!!!!!!!!!!!
if($this->input->cookie("partner_id") == 'NULL'){ // TODO ?> 
<div class="banner">
	<table class="banner-headline">
		<tr>
			<td><h1><span>Herzlich Willkommen!</span></h1></td>
		</tr>
	</table>
	<div class="banner-content">
		<?php
		$r = $this->P_account_model->get_account("all")->result();
		$n = count($r);
		$width = 200/$n;
		$height = 200/$n;
		foreach ($r as $row) {
		echo '<div class="logo-item">
				<table>
					<tr>
						<td><img width="'.$width.'" height="'.$height.'" src="'.$this->P_account_model->get_logo($cdn_url, $row->company_id).'" alt="'.$row->company_name.'" /></td>
					</tr>
				</table>
			  </div>';
		}
		?>
	</div>	
</div>
<?php }else{ ?>
<div class="banner" style="background-size: cover;background-repeat: no-repeat;background-position: center center; background-image: url(<?=$this->P_account_model->get_banner($cdn_url, $this->input->cookie("partner_id")) ?>)">
	<table class="partner-logo">
		<tr>
			<td><img width="100px" height="100px" src="<?=$this->P_account_model->get_logo($cdn_url, $this->input->cookie("partner_id"))  ?>"></td> <!-- Hab eine statische Width,Height initialisiert -->
		</tr>
	</table>
</div>
<?php } ?>
<div class="container">
	<div class="container-content" style="max-width:450px;">
		<div class="placeholder"></div>
		<div class="column-1"> 
			<div class="column-content">
				<h1 class="text-center" style="margin-bottom:20px;"><?=($this->input->cookie("partner_id") == NULL ? "Anmelden" : "Willkommen zurück" ) ?></h1>
				<form methode="post" data-url="/P_ajax/account/signin/" data-redirect="/partner" data-type="normal"> <!-- Angepasst ajax auf P_ajax-->
					<label for="signin_username">E-Mail-Adresse</label>
					<input type="text" name="username" id="signin_username"<?=($this->input->cookie("partner_id") == NULL ? '' : ' value="'.$object_account->company_email.'"')?>>
					<label for="signin_password">Passwort</label>
					<input type="password" name="password" id="signin_password">
					<hr />
					<table style="width:100%; border-collapse:collapse; border-spacing:0; margin-bottom:10px;">
						<tr>
							<td class="text-left"><input type="checkbox" name="email_save" id="signin_email_save" style="width: auto; height: auto;" value="1"<?=($this->input->cookie("partner_id") == NULL ? ' ' : ' checked="checked"')?>/><label for="signin_email_save" style="font-weight:300;">E-Mail-Adresse merken</label></td>
							<td class="text-right"><a href="/support/">Brauchen Sie Hilfe?</a></td>
						</tr>
					</table>
					<button class="submit">Anmelden</button>
				</form>
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
