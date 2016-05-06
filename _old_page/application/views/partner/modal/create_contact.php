<style type="text/css">
#picture-preview{
	text-align: center;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '#picture-preview',
		p_format: '<img class="circle-image large border" src="{0}" />'
	});
});	
</script>
<form methode="post" data-url="/ajax/contact/create_contact/" data-type="normal" data-redirect="/">
	<div class="column-2">
		<div class="column-content">
			<label for="file">Portrait</label>
			<div class="text-center">
				<table style="height:200px; width:200px; margin:0 auto;">
					<tr>
						<td id="picture-preview"><img class="circle-image large border" src="<?=$resource_url; ?>image/partner/contact/male.png" /></td>
					</tr>
				</table>
			</div>
			<div class="file-selector">
				<input type="file" name="file[]" id="file" accept="image/jpeg, image/png, image/jpg">
				Foto auswählen...
			</div>
			<br />
			<table style="width: 100%; border-spacing:0; border-collapse: collapse;">
				<tr>
					<td style="width: 49%; padding-right:1%;">
						<label>Anrede</label>
						<div class="select-box">
							<select name="gender">
								<option value="0">Anrede auswählen...</option>
								<?php foreach ($this->General_Model->get_gender()->result() as $row) { ?>
								<option value="<?=$row->gender_id; ?>"><?=$this->lang->line("gender_title_".$row->gender_description); ?></option>
								<?php } ?>
							</select>
						</div>
					</td>
					<td style="width: 49%; padding-left:1%;">
						<label for="contact_title">Titel</label>
						<input type="text" name="title" id="contact_title" />
					</td>
				</tr>
			</table>
			<label for="contact_firstname">Vorname</label>
			<input type="text" name="firstname" id="contact_firstname" />
			<label for="contact_lastname">Nachname</label>
			<input type="text" name="lastname" id="contact_lastname" />
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<label for="contact_position">Position</label>
			<input type="text" name="position" id="contact_position" />
			<label for="contact_email">E-Mail-Adresse</label>
			<input type="text" name="email" id="contact_email" />
			<label for="contact_phone">Telefon</label>
			<input type="text" name="phone" id="contact_phone" />
			<label for="contact_fax">Fax</label>
			<input type="text" name="fax" id="contact_fax" />
			<label for="contact_tip">Ihr Tipp für Bewerber</label>
			<textarea id="contact_tip" name="tip" style="height:144px;"></textarea>
			<button class="submit">Hinzfügen</button>
		</div>
	</div>
</form>