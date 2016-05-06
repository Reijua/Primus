<?php /* if($this->input->cookie("partner_id") == NULL){ ?>
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
<?php } */ ?>
<div class="banner" style="background-image: url(<?php echo $resource_url; ?>image/banner/city.jpg);"></div>
<div class="container">
	<div class="container-content" style="max-width:450px;">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content">
				<h1 class="text-center" style="margin-bottom:20px;"><?=($this->input->cookie("partner_id") == NULL ? "Anmelden" : "Willkommen zurück" ) ?></h1>
				<form methode="post" data-url="/ajax/account/login/" data-redirect="/" data-type="normal">
					<label for="signin_username">E-Mail-Adresse</label>
					<input type="text" name="username" id="signin_username"<?=($this->input->cookie("partner_id") == NULL ? '' : ' value="'.$object_account->company_email.'"')?>>
					<label for="signin_password">Passwort</label>
					<input type="password" name="password" id="signin_password">
					<hr />
					<table style="width:100%; border-collapse:collapse; border-spacing:0; margin-bottom:10px;">
						<tr>
							<td class="text-left">
								<input type="checkbox" name="email_save" id="signin_email_save" style="width: auto; height: auto;" value="1"<?=($this->input->cookie("partner_id") == NULL ? ' ' : ' checked="checked"')?>/>
								<label for="signin_email_save" style="font-weight:300;">E-Mail-Adresse merken</label>
							</td>
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
