<div class="container">

	<?= $message ?>

</div>

<?php if (empty($message)): ?>

<div class="container contact-container">

	<h1 class="text-center">

		<?= lang('contact_heading') ?>

	</h1>

	<form class="form-horizontal" method="post" action="/contact">

		<input type="hidden" name="form" value="true">

		<div class="form-group">

			<label for="salutation" class="col-sm-3 control-label"><?= lang('contact_salutation') ?></label>

			<div class="col-sm-9">

				<select class="form-control" id="salutation" name="salutation">

					<option value="-" <?= set_select('salutation', '-', TRUE); ?>>

						<?= lang('contact_salutation_placeholder') ?>

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

			<label for="firstname" class="col-sm-3 control-label">

				<?= lang('contact_firstname') ?>

			</label>

			<div class="col-sm-9">

				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?= lang('contact_firstname_placeholder') ?>" value="<?= set_value('firstname') ?>">

				<?= form_error('firstname') ?>

			</div>

		</div>

		<div class="form-group">

			<label for="lastname" class="col-sm-3 control-label">

				<?= lang('contact_lastname') ?>

			</label>

			<div class="col-sm-9">

				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?= lang('contact_lastname_placeholder') ?>" value="<?= set_value('lastname') ?>">

				<?= form_error('lastname') ?>

			</div>

		</div>

		<div class="form-group">

			<label for="email" class="col-sm-3 control-label">

				<?= lang('contact_email') ?>

			</label>

			<div class="col-sm-9">

				<input type="email" class="form-control" id="email" name="email" placeholder="<?= lang('contact_email_placeholder') ?>" value="<?= set_value('email') ?>">

				<?= form_error('email') ?>

			</div>

		</div>

		<div class="form-group">

				<label for="message" class="col-sm-3 control-label"><?= lang('contact_message') ?></label>

				<div class="col-sm-9">

					<textarea class="form-control" rows="8" id="message" name="message" placeholder="<?= lang('contact_message_placeholder') ?>"><?= set_value('message') ?></textarea>

					<?= form_error('message') ?>

				</div>

			</div>

			<div class="form-group">

				<div class="col-sm-offset-3 col-sm-9">

					<button type="submit" class="btn btn-primary">

						<?= lang('contact_button') ?>

					</button>

				</div>
        <p style="text-align: center;">
          Felder mit * sind Pflichtfelder und müssen ausgefüllt werden!
        </p>
			</div>

		</form>

	</div>

</div>

<?php endif; ?>