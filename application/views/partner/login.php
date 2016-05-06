<div class="container">
	<?php if (!empty($type) && !empty($message)): ?>

	<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?= $message ?>
	</div>

	<?php endif; ?>
	<div class="login-container">
		<h1 class="text-center"><?= lang('auth_login_heading') ?></h1>
		<form class="form-horizontal" method="post" action="/partner/login">
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label"><?= lang('auth_login_email') ?></label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" placeholder="<?= lang('auth_login_email_placeholder') ?>" value="<?= set_value('email') ?>">
					<?= form_error('email') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label"><?= lang('auth_login_password') ?></label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" name="password" placeholder="<?= lang('auth_login_password_placeholder') ?>" value="<?= set_value('password') ?>">
					<?= form_error('password') ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-5 col-xs-6">
					<button type="submit" class="btn btn-primary"><?= lang('auth_login_button') ?></button>
				</div>
				<div class="col-sm-5 col-xs-6">
					<div class="pull-right">
						<a href="?forgot=password"><?= lang('auth_login_forgot') ?></a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>