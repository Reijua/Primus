<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
});
</script>
<div class="column-1" style="width:100%; height:100%; overflow: auto;">
	<form methode="post" data-type="normal" data-url="/ajax/feed/create_feedpost/" data-redirect="/">
		<div class="column-2">
			<div class="column-content">
				<label for="file">Intro-Bild</label>
				<div class="text-center">
					<table style="height: 200px; width: 200px; margin: 0 auto; overflow: hidden;">
						<tr>
							<td id="picture-preview">
								<div class="modal-intro-image squared-image large border" style="height: 200px; width: 200px; background: url('http://partner.primus-romulus.net/resource/image/post/noimage.jpg') 50% 50% no-repeat;"></div>
							</td>
						</tr>
					</table>
				</div>
				<div class="file-selector">
					<input type="file" name="file[]" id="file" accept="image/jpeg, image/png, image/jpg" onchange="updateImage(this);">
					Bild auswählen...
				</div>

				<script type="text/javascript">

				function updateImage(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function(e) {
							$('.modal-intro-image').css('background', 'url(' + e.target.result + ') 50% 50% no-repeat');
							$('.modal-intro-image').show();
						};

						reader.readAsDataURL(input.files[0]);
					}
				}

				</script>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<label for="post_text">Text</label>
				<textarea name="text" id="post_text" style="height: 376px; min-height:376px;"></textarea>
			</div>
		</div>
		<div class="column-1">
			<div class="column-content">
				<button class="submit">Posten</button>
			</div>
		</div>
	</form>
</div>