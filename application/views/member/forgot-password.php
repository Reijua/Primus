<div class="container">
	<?php if (!empty($type) && !empty($message)): ?>

	<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
		<?= $message ?>
	</div>

	<?php endif; ?>
	<div class="forgot-password-container">
		<h1 class="text-center">Passwort vergessen?</h1>
		<p>
			Bitte geben Sie die E-Mail-Adresse ein, mit welcher Sie sich bei Primus Romulus registriert haben!<br />
			Wir werden Ihnen eine E-Mail senden, damit Sie Ihr Passwort zurücksetzten können.
		</p>
		<form method="post" action="/member/login?forgot=password">
			<input type="hidden" name="form" value="true">
			<div class="form-group">
				<label for="email">E-Mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="E-Mail-Adresse">
			</div>
			<button type="submit" class="btn btn-primary">Absenden</button>
		</form>
	</div>
</div>