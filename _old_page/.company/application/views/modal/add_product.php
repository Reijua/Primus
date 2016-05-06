<style type="text/css">
.image-upload .preview img{
	border-radius: 0;
	padding: 0;
	border:0px #FFFFFF !important;
}
.image-upload .preview{
	width: 202px;
	background-color: #FFFFFF;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
	$(".image-upload").initFilePreview();
});
</script>
<div class="column-1" style="overflow:auto; height:100%;">
	<div class="column-2">
		<div class="column-content">
			<label>Produktfoto</label>
			<div class="image-upload">
				<div class="preview">
					<img src="" id="preview-portrait" width="200px" height="395px">
					<div class="hover">
						Bild auswählen.
						<input type="file" name="file" id="file" multiple="multiple">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="column-2">
		<div class="column-content">
			<label for="product_name">Bezeichnung</label>
			<input type="text" name="name" id="product_name" />
			<label>Preis</label>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<input type="text" name="name" id="product_name" />
					</td>
					<td>
						<div class="select-box">
							<select name="interval"  style="padding-left:10px;">
							<?php
							foreach ($array_interval as $row) {
							echo '<option value="'.$row->interval_id.'">'.$this->lang->line('interval_'.$row->interval_name).'</option>';
							}
							?>
							</select>
						</div>
					</td>
					<td>
						<div class="select-box">
							<select name="currency" style="padding-left:10px;">
							<?php
							foreach ($array_currency as $row) {
							echo '<option value="'.$row->currency_id.'">'.$row->currency_name.'</option>';
							}
							?>
							</select>
						</div>
					</td>
				</tr>
			</table>
			<label for="product_description">Beschreibung</label>
			<textarea style="max-width:96%;height:200px;" name="description" id="product_description"></textarea>
			<label for="product_link">Link für mehr Informationen</label>
			<input type="text" name="link" id="product_link" />

		</div>
	</div>
</div>