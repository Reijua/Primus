<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '#gallery-preview',
		p_format: '<div class="column-6 item" style="background-image:url({0});"></div>'
	});
});
</script>
<style type="text/css">
#gallery-preview{}
	#gallery-preview .item{
		height: 150px;
		background-position:center;
		background-repeat: no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
</style>
<div class="column-1" style="width:100%; height:100%; overflow: auto;">
	<form methode="post" data-type="normal" data-url="/ajax/gallery/update_gallery/" data-redirect="/">
		<div class="column-2">
			<div class="column-content">
				<input type="hidden" name="id" value="<?=$object_gallery->gallery_id; ?>">
				<label>Name</label>
				<input type="text" name="name" id="gallery_name" value="<?=$object_gallery->gallery_name; ?>">
				<div class="file-selector">
					<input type="file" id="file" multiple="multiple" accept="image/jpg,image/png,image/jpeg" />
					<div class="text">Bilder auswählen...</div>
				</div>				
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label>Beschreibung</label>
				<textarea name="description" id="gallery_description" style="height: 75px; max-height:75px;"><?=$object_gallery->gallery_description; ?></textarea>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content" id="gallery-preview">
				<?php
				foreach ($this->Gallery_Model->get_item($object_gallery->gallery_id) as $row => $value) {
					echo '<div class="column-6 item" style="background-image:url('.$cdn_url.'image/gallery/'.$object_gallery->gallery_id.'/'.$value.');"></div>';
				}
				?>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content"><button class="submit">Bearbeiten</button></div>
		</div>
	</form>
</div>