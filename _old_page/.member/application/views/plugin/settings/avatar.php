<style type="text/css">
.profile-image{
	position: relative;
	float: left;
	text-align: center;
	width: 100%;
}
	.profile-image img{
		width: 148px;
		height: 148px;
		margin: 5px 0;
		padding: 0;
		border:1px solid #CCCCCC;
		border-radius: 200px;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '.profile-image',
		p_format: '<img src="{0}" alt="Vorschau: Profilbild" />'
	});
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Profilbild</h4>
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<strong>Information</strong><br />
		Damit Ihr Profilbild richtig zur Geltung kommt, sollten Sie es in der optionalen Größe beziehungsweise im richtigen Format hochladen.<br />
		<br />
		<strong>Größe:</strong>
		<table class="table">
			<tr>
				<td>Minmal</td>
				<td>Optiomal</td>
				<td>Maximal</td>
			</tr>
			<tr>
				<td>200px x 200px</td>
				<td>300px x 300px</td>
				<td>500px x 500px</td>
			</tr>
		</table>
		<strong>Format:</strong>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="50%">
					<ul>
						<li>Portable Network Graphics (PNG)</li>
						<li>JEPG</li>
					</ul>
				</td>
				<td width="50%">
					<ul>
						<li>JPG</li>
						<li>GIF</li>
					</ul>
				</td>
			</tr>
		</table>
		<strong>Hilfe</strong>
		
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<div class="profile-image">
			<img src="<?php echo ($object_account->member_profile_image!="" ? $object_account->member_profile_image : (($object_account->gender_description == "female") ? $resource_url.'image/avatar/female.png' : $resource_url.'image/avatar/male.png' )) ?>" alt="Vorschau: Profilbild">
		</div>
		<div class="column-1">
		<form methode="post" data-url="/ajax/account/upload_avatar/" data-type="normal" data-redirect="/">
			<table style="width:100%; border-collapse:0; border-spacing:0;">
				<tr>
					<td style="width:50%;">
						<div class="file-selector">
							<input type="file" name="file[]" id="file" accept="image/jpeg, image/png">
							Profilebild auswählen...
						</div>
					</td>
					<td style="width:50%;">
						<button class="submit">Speichern</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
		<table style="width:100%; border-collapse:0; border-spacing:0;">
			<tr>
				<td style="width:100%;">
					<form methode="post" form-url="/ajax/account/remove_logo/" form-type="confirm" form-redirect="/" form-message="Wollen Sie Ihr Profilbild wirklich löschen?" status="true"><button id="submit" style="margin:0px;">Profilbild löschen</button></form>
				</td>
			</tr>
		</table>
	</div>
</div>