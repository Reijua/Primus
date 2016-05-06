<div class="container">
	<?php if (!empty($type) && !empty($message)): ?>

	<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?= $message ?>
	</div>

	<?php endif; ?>
	<div class="register-container">
		<h1 class="text-center"><?= lang('auth_register_heading') ?></h1>
		<form class="form-horizontal" method="post" action="/member/register">
			<div class="form-group">
				<label for="salutation" class="col-sm-3 control-label"><?= lang('auth_register_salutation') ?></label>
				<div class="col-sm-9">
					<select class="form-control" id="salutation" name="salutation">
						<option value="-" <?= set_select('salutation', '-', TRUE); ?>>
							<?= lang('auth_register_salutation_placeholder') ?>
						</option>
						<option value="female" <?= set_select('salutation', 'female'); ?>>
							<?= lang('general_salutation_female') ?>
						</option>
						<option value="male" <?= set_select('salutation', 'male'); ?>>
							<?= lang('general_salutation_male') ?>
						</option>
					</select>
					<?= form_error('salutation') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-3 control-label"><?= lang('auth_register_title') ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="title" name="title" placeholder="<?= lang('auth_register_title_placeholder') ?>" value="<?= set_value('title') ?>">
					<?= form_error('title') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="firstname" class="col-sm-3 control-label"><?= lang('auth_register_firstname') ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?= lang('auth_register_firstname_placeholder') ?>" value="<?= set_value('firstname') ?>">
					<?= form_error('firstname') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="lastname" class="col-sm-3 control-label"><?= lang('auth_register_lastname') ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?= lang('auth_register_lastname_placeholder') ?>" value="<?= set_value('lastname') ?>">
					<?= form_error('lastname') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="birthdate" class="col-sm-3 control-label"><?= lang('auth_register_birthdate') ?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="<?= lang('auth_register_birthdate_placeholder') ?>" value="<?= set_value('birthdate') ?>">
					<?= form_error('birthdate') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label"><?= lang('auth_register_email') ?></label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="email" placeholder="<?= lang('auth_register_email_placeholder') ?>" value="<?= set_value('email') ?>">
					<?= form_error('email') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-3 control-label"><?= lang('auth_register_password') ?></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password" name="password" placeholder="<?= lang('auth_register_password_placeholder') ?>">
					<?= form_error('password') ?>
				</div>
			</div>
			<div class="form-group">
				<label for="confirm-password" class="col-sm-3 control-label"><?= lang('auth_register_confirm_password') ?></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="<?= lang('auth_register_confirm_password_placeholder') ?>">
					<?= form_error('confirm-password') ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-primary"><?= lang('auth_register_button') ?></button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#birthdate').datetimepicker({
			locale: <?= get_cookie('language') == 'english' ? "'en-gb'" : "'de'" ?>,
			format: 'L',
			minDate: moment('01/01/1960')
		});
	});
</script>