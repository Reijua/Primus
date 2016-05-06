<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$(this).base64upload();
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
		
		<br />
		<br />
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<div class="text-center" id="plugin-logo-preview" >
			<img src="<?php echo ($object_account->company_logo!='' ? $object_account->company_logo : $resource_url.'image/company/logo/default.png') ?>"/>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin:1px; padding:1px;">
				<div class="base64-upload">
					<input type="file" multiple="multiple" data-url="/ajax/account/upload_logo/">
					<button>Profilbild auswählen</button>
				</div>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content" style="margin:1px; padding:1px;">
				<form methode="post" form-url="/ajax/account/remove_logo/" form-type="confirm" form-redirect="/" form-message="Wollen Sie Ihr Profilbild wirklich löschen?"><button id="submit" style="margin:0px;">Profilbild löschen</button></form>
			</div>
		</div>
	</div>
</div>