<div class="modal-content edit-post" id="modal-replace">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Partner bearbeiten</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="email">E-Mail</label> (Bei einer neuen E-Mail muss auch ein neues Passwort gesetzt werden)
						<input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?= empty(form_error('email')) ? $email : set_value('email') ?>">
						<?= form_error('email'); ?>
					</div>
					<div class="form-group">
						<label for="password">Neues Passwort</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Passwort" value="<?= set_value('password') ?>">
						<?= form_error('password'); ?>
					</div>
					<div class="form-group">
						<label for="confirm-password">Passwort wiederholen</label>
						<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Passwort wiederholen" value="<?= set_value('confirm-password') ?>">
						<?= form_error('confirm-password'); ?>
					</div>
					<div class="form-group">
						<label for="company-name">Firmenname</label>
						<input type="text" class="form-control" id="company-name" name="company-name" placeholder="Firmenname" value="<?= empty(form_error('company-name')) ? $company_name : set_value('company-name')?>">
						<?= form_error('company-name'); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Paket</label><br />
						<label for="bronze">
							<input type="radio" name="packet" value="1" id="bronze" <?php echo set_value('packet', '1'); ?> <?php if($packet == 1) echo "checked"; ?>> Bronze
						</label><br />
						<label for="silber">
							<input type="radio" name="packet" value="2" id="silber" <?php echo set_value('packet', '2'); ?> <?php if($packet == 2) echo "checked"; ?>> Silber
						</label><br />
						<label for="gold">
							<input type="radio" name="packet" value="3" id="gold" <?php echo set_value('packet', '3'); ?> <?php if($packet == 3) echo "checked"; ?>> Gold
						</label>
						<?= form_error('packet'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
		<button type="button" class="btn btn-success" id="save">Speichern</button>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#save').click(function(e) {
		e.stopImmediatePropagation();

		$('.modal-footer button').prop('disabled', true);
		$(this).html('Bitte warten ...');
		savePost();

		return false;
	});


	function savePost() {
		// Manipulate form data to correctly upload files
		var data = new FormData();
		data.append('form', true);
		data.append('email', $('#email').val());
		data.append('password', $('#password').val());
		data.append('confirm-password', $('#confirm-password').val());
		data.append('packet', $("input[name='packet']:checked").val());
		data.append('company-name', $('#company-name').val());

		$.ajax({
			type: 'POST',
			url: '/admin/partnerfunction/edit-partner/<?= $id ?>',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				$('#modal-replace').replaceWith(data);
			}
		});
	}
});

</script>