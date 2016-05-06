<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
	$(".image-upload").initFilePreview();
});
</script>
<div class="column-1" style="overflow:auto; height:100%;">
	<div class="column-2">
		<div class="column-content">
			<strong>Information</strong><br />
			So einfach geht es...
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<form methode="post" form-url="/ajax/account/add_contact/" form-type="normal" form-redirect="/">
				<label for="file">Portrait</label>
					<div class="image-upload">
						<div class="preview">
							<img src="<?php echo $resource_url.'image/portrait/male.png'; ?>" id="preview-portrait" width="100px">
							<div class="hover">
								Bild auswählen.
								<input type="file" name="file" id="file" multiple="multiple">
							</div>
						</div>
					</div>	
				<label for="contact_salutation">Anrede</label>
				<div class="select-box">
					<select id="contact_salutation" name="salutation">
						<option>Anrede auswählen...</option>
						<?php
						foreach ($array_gender as $row) {
						echo '<option value="'.$row->gender_id.'">'.$this->lang->line('gender_salutation_'.$row->gender_name).'</option>';
						}
						?>
					</select>
				</div>
				<label for="contact_title">Titel</label>
				<input type="text" name="title" id="contact_title" />
				<label for="contact_firstname">Vorname</label>
				<input type="text" name="firstname" id="contact_firstname" />
				<label for="contact_lastname">Nachname</label>
				<input type="text" name="lastname" id="contact_lastname" />
				<label for="contact_position">Position</label>
				<input type="text" name="position" id="contact_position" />
				<label for="contact_email">E-Mail-Adresse</label>
				<input type="text" name="email" id="contact_email" />
				<label for="contact_phone">Telefon</label>
				<input type="text" name="phone" id="contact_phone" />
				<button id="submit">Hinzufügen</button>
			</form>
		</div>
	</div>
</div>