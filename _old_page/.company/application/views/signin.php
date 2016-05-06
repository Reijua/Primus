<?php if($this->input->cookie('account_id') != null){ ?>
<?php $object_account = $this->Account_Model->get_detail(intval($this->input->cookie('account_id')))->row(); ?>
<div class="banner-wrapper" style="<?php echo ($object_account->company_banner==''? '' : 'background-image: url('.$object_account->company_banner.');'); ?>">
	<div class="company-logo">
		<img src="<?php echo ($object_account->company_logo==''? $resource_url.'image/company/logo/default.png' : $object_account->company_logo); ?>">
	</div>
</div>
<?php }else{ ?>
<div class="banner-wrapper">
</div>
<?php } ?>
<div id="content-wrapper">
	<div id="content-holder">
		<div class="column-1">
			<div class="column-content text-center">
				<h2>Anmelden</h2>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" style="max-width:400px; margin:0 auto;">
				<form methode="post" form-url="/ajax/account/signin/" form-redirect="/" form-type="normal">
					<label for="login_username">E-Mail-Adresse</label>
					<input type="email" id="login_username" name="username" value="<?php echo $this->input->cookie('account_email'); ?>" />
					<label for="login_password">Passwort</label>
					<input type="password" id="login_password" name="password" />
					<hr color="#CCCCCC" />
					<button id="submit">Anmelden</button>
				</form>
				<div class="text-center" style="margin:20px 0;">
					<a href="/recovery/">Können Sie nicht auf Ihr Konto zugreifen?</a>
				</div>				
			</div>
		</div>
	</div>
</div>
<div class="divider" id="white-dark-grey"></div>