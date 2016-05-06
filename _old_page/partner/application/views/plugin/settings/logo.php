<style type="text/css">
#logo-preview{
	width: 100%;
	height: 100%;
	text-align: center;
	background-color: #FFFFFF;
	vertical-align: middle;
}
	#logo-preview img{
		width: auto;
		height: auto;
		max-width: 180px;
		max-height: 180px;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '#logo-preview',
		p_format: '<img src="{0}" alt="Vorschau: Logo" />'
	});
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Logo</h4>
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<div class="column-1 text-center" >
			<table style="width:200px; height:200px; margin: 0 auto;">
				<tr>
					<td id="logo-preview"><img src="<?=$this->Account_Model->get_logo($cdn_url, $object_account->company_id); ?>" class="squared-image large" alt="Vorschau: Logo"></td>
				</tr>
			</table>
		</div>
		<div class="column-1">
		<form methode="post" data-url="/ajax/account/upload_logo/" data-type="normal" data-redirect="/">
			<table style="width:100%; border-collapse:0; border-spacing:0;">
				<tr>
					<td style="width:50%;">
						<div class="file-selector">
							<input type="file" name="file[]" id="file" accept="image/jpeg, image/png">
							Logo auswählen...
						</div>
					</td>
					<td style="width:50%;">
						<button class="submit">Speichern</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div>
</div>