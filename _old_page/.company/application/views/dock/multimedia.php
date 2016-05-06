<style type="text/css">
.photo-thumbnail{
	position: relative;
	float: left;
	width: 16.66666667%;
	cursor: pointer;
	background-color: #FFFFFF;
}
	.photo-thumbnail .photo-preview{
		height: 200px;
		width: 100%;
		background-repeat:no-repeat;
		background-size: cover;
		background-color: #FFFFFF;
	}
		.photo-thumbnail .photo-preview .settings{
			display: none;
		}
		.photo-thumbnail .photo-preview:hover .settings{
			display: block;
			height: 100%;
			width: 100%;
			background-color: rgba(0,0,0,.4);
		}
.video-thumbnail{
	position: relative;
	cursor: pointer;
	background-color: #FFFFFF;
}
	.video-thumbnail .video-preview{
		height: 200px;
		width: 100%;
		background-repeat:no-repeat;
		background-size: cover;
		background-color: #000000;
	}

@media screen and (max-width: 800px){
	.photo-thumbnail{
		position: relative;
		float: left;
		width: 33.333333333334%;
		cursor: pointer;
		background-color: #FFFFFF;
	}
}
@media screen and (max-width: 400px){
	.photo-thumbnail{
		position: relative;
		float: left;
		width: 50%;
		cursor: pointer;
		background-color: #FFFFFF;
	}
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(document).initLightbox();
		$(document).initFormSystem();
	});
</script>
<div class="column-1">
	<div class="column-content">
		<h2>Fotos</h2>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Fotos hinzufügen" modal-type="url" modal-data="/ajax/modal/add_photo/">Fotos hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<div class="column-1">
	<div class="column-content" id="lightbox">
<?php
foreach ($this->Multimedia_Model->get_photo($this->session->userdata('account_id'))->result() as $row) {
	echo '
		<div class="photo-thumbnail">
			<div class="photo-preview" style="background-image:url('.$row->photo_data.'); background-position:center center;">
				<div class="settings">
					<table style="width:100%; border-collapse:0; border-spacing:0; position:absolute; top:85px;">
						<tr>
							<td style="width:48%; padding:0 1%;"><button class="lightbox" lightbox-data="'.$row->photo_data.'">Vorschau</button></td>
							<td style="width:48%; padding:0 1%;"><form methode="post" form-type="confirm" form-message="Wollen Sie das Foto wirklich löschen?" form-url="/ajax/multimedia/delete_photo/" form-redirect="/"><input type="hidden" value="'.$row->photo_id.'" name="id" /><button id="submit">Löschen</button></form></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	';
}
?>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<h2>Videos</h2>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Video hinzufügen" modal-type="url" modal-data="/ajax/modal/add_video/">Video hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<?php
foreach ($this->Multimedia_Model->get_video($this->session->userdata('account_id'))->result() as $row) {
	switch ($row->type_name) {
		case 'YouTube':
			$url_string = parse_url($row->video_url, PHP_URL_QUERY);
			parse_str($url_string, $args);
			echo '
				<div class="column-4">
					<div class="column-content">
						<div class="video-thumbnail">
							<div class="video-preview" style="background-image:url(http://img.youtube.com/vi/'.$args['v'].'/0.jpg); background-position:center center;"></div>
							<table style="width:100%; border-collapse: 0; border-spacing: 0;">
								<tr>
									<td style="width:49%; padding-right:1%;"><button class="modal" modal-title="'.$row->video_name.'" modal-type="youtube" modal-data="'.$args['v'].'">Ansehen</button></td>
									<td style="width:49%; padding-left:1%;"><form methode="post" form-type="confirm" form-message="Wollen Sie das Video wirklich löschen?" form-url="/ajax/multimedia/delete_video/" form-redirect="/"><input type="hidden" value="'.$row->video_id.'" name="id" /><button id="submit">Löschen</button></form></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			';
		break;
		case 'Vimeo':
		$video_id = preg_split("[/]",substr(parse_url($row->video_url, PHP_URL_PATH), 1))[count(preg_split("[/]",substr(parse_url($row->video_url, PHP_URL_PATH), 1)))-1];
		$video_thumb = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$video_id.".php"));
		echo '
				<div class="column-4">
					<div class="column-content">
						<div class="video-thumbnail">
							<div class="video-preview" style="background-image:url('.$video_thumb[0]["thumbnail_large"].'); background-position:center center;"></div>
							<table style="width:100%; border-collapse: 0; border-spacing: 0;">
								<tr>
									<td style="width:49%; padding-right:1%;"><button class="modal" modal-title="'.$row->video_name.'" modal-type="vimeo" modal-data="'.$video_id.'">Ansehen</button></td>
									<td style="width:49%; padding-left:1%;"><form methode="post" form-type="confirm" form-message="Wollen Sie das Video wirklich löschen?" form-url="/ajax/multimedia/delete_video/" form-redirect="/"><input type="hidden" value="'.$row->video_id.'" name="id" /><button id="submit">Löschen</button></form></td>
								</tr>
							</table>
						</div>
					</div>
				</div>';
		break;
		
		default:
		break;
	}
	
}
?>
