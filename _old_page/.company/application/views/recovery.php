<div class="banner-wrapper" style="background-image: url(<?php echo $resource_url; ?>image/banner/recovery.png);">
</div>
<div id="content-wrapper">
	<div id="content-holder">
		<div class="column-1">
			<div class="column-content text-center">
				<h2>Anmeldedaten zurücksetzen</h2>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" style="max-width:400px; margin:0 auto;">
				<form methode="post" form-url="/ajax/account/recovery/" form-redirect="/" form-type="normal">
					<label for="recovery_name">Firmenname</label>
					<input type="text" id="recovery_name" name="name" />
					<label for="recovery_email">E-Mail-Adresse</label>
					<input type="email" id="recovery_email" name="email" />
					<hr color="#CCCCCC" />
					<button id="submit">Zugangsdaten zurücksetzen</button>
				</form>
				<div class="text-center" style="margin:20px 0;">
					<a href="/signin/">Zurück zur Anmeldung</a>
				</div>				
			</div>
		</div>
	</div>
</div>
<div class="divider" id="white-dark-grey"></div>