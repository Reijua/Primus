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
	<div class="container-content" style="max-width:550px;">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content">
				<h1 class="text-center" style="margin-bottom:20px;">Passwort wiederherstellen</h1>
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
		<div class="placeholder"></div>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>