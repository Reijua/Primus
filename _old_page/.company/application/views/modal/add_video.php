<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
});
</script>
<div class="column-2">
	<div class="column-content">
		<strong>Information</strong><br />
		So einfach geht es...
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<form methode="post" form-url="/ajax/multimedia/add_video/" form-type="normal" form-redirect="/">
			<label for="video_title">Titel</label>
			<input type="name" name="title" id="video_title" />
			<label for="video_provider">Anbieter</label>
			<div class="select-box">
				<select id="video_provider" name="provider">
					<option>Bitte Anbieter auswählen...</option>
					<?php
					foreach ($array_provider as $row) {
					echo '<option value="'.$row->type_id.'">'.$row->type_name.'</option>';
					}
					?>
				</select>
			</div>
			<label for="video_url">URL</label>
			<input type="name" name="url" id="video_url" />
			<button id="submit">Hinzufügen</button>
		</form>
	</div>
</div>