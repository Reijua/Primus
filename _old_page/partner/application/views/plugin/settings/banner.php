<style type="text/css">
#banner-preview{
	height: 300px;
	border: 1px solid #CCCCCC;
	background-color: #FFFFFF;
	margin-bottom: 10px;
}
	#banner-preview #banner-image{
		height: 100%;
		width: 100%;
		background-repeat: no-repeat;
		background-position: center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
	$("#file").initFilePreview({
		p_target: '#banner-preview',
		p_format: '<div id="banner-image" style="background-image:url({0});"></div>'
	});
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Banner</h4>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<div id="banner-preview">
			<div id="banner-image" style="background-image: url(<?=$this->Account_Model->get_banner($cdn_url, intval($this->session->userdata("account_id")));?>)"></div>
		</div>
		<form methode="post" data-url="/ajax/account/upload_banner/" data-type="normal" data-redirect="/">
			<table style="width:100%; border-spacing:0; border-collapse: collapse;">
				<tr>
					<td style="width:49%; padding-right: 1%;">
						<div class="file-selector">
							<input type="file" name="file[]" id="file" accept="image/jpeg, image/png">
							Banner auswählen...
						</div>
					</td>
					<td style="width:49%; padding-left: 1%;"><button class="submit">Speichern</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>