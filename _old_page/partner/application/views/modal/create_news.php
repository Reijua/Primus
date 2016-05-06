<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '.banner-preview',
		p_format: '<div class="banner-image" style="background-image:url({0}); width:100%; height:100%; background-position:center; background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>'
	});
	$("#gallery").initDynamicField({
		p_field: '<div class="responsive-table"><table class="field" style="width:100%; border-collapse: 0; border-spacing: 0;"><tbody><tr><td><div class="select-box"><select name="gallery[]"><option value="0">Gallery auswählen...</option><?php foreach ($this->Gallery_Model->get_gallery()->result() as $row) { echo "<option value=\"".$row->gallery_id."\">".$row->gallery_name."</option>";} ?></select></div></td><td class="text-right"><span class="link btn-delete">Löschen</span></td></tr><tbody></table></div>'
	});
});
</script>
<div class="column-1" style="height:100%; overflow:auto;">
	<form methode="post" data-url="/ajax/news/create_news/" data-type="normal" data-redirect="/">
		<div class="column-1">
			<div class="column-content">
				<label>Banner</label>
				<div class="banner-preview" style="height:200px; background-color:#FFFFFF; border:1px solid #CCCCCC; margin-bottom:5px;">
					
				</div>
				<table style="width:100%; border-collapse:0; border-spacing:0;">
					<tr>
						<td style="width:100%;">
							<div class="file-selector">
								<input type="file" name="file[]" id="file" accept="image/jpeg, image/png">
								Profilebild auswählen...
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label for="news_title">Titel</label>
				<input type="text" name="title" id="news_title">
				<label for="news_text">Inhalt</label>
				<textarea name="text" id="news_text" style="height:150px; max-height:150px;"></textarea>
				
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">

				<label for="news_title">Kategorie</label>
				<div class="select-box">
					<select name="category">
						<option value="0">Kategorie auswählen...</option>
						<?php
						foreach ($this->News_Model->get_category()->result() as $row) {
							echo '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
						}
						?>
					</select>
				</div>
				
				<label>Gallery</label>
				<div class="dynamic-fields" id="gallery">
					<div class="dynamic-content">
						
					</div>
					<div class="dynamic-footer">
						<span class="link">Feld hinzufügen</span>
					</div>
				</div>
				<hr style="color: #CCCCCC;">
				<button class="submit">Erstellen</button>
				
				
			</div>
		</div>
	</form>
</div>