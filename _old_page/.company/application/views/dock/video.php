<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(this).initFormSystem();
	});
</script>

<div class="column-1">
	<div class="column-content">
		<h3>Videos</h3>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Video hinzufügen" modal-type="url" modal-data="/ajax/modal/add_video/">Hinzufügen</li>
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
						<div class="video-thumb">
							<img src="http://img.youtube.com/vi/'.$args['v'].'/0.jpg" width="100%" />
							<div class="settings">
								<ul>
									<li class="modal" modal-title="'.$row->video_name.'" modal-type="youtube" modal-data="'.$args['v'].'">Ansehen</li>
									<li><form methode="post" form-type="confirm" form-message="Wollen Sie das Video wirklich löschen?" form-url="/ajax/multimedia/delete_video/" form-redirect="/"><input type="hidden" value="'.$row->video_id.'" name="id" /><span id="submit">Löschen</span></form></li>
								</ul>
							</div>
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
						<div class="video-thumb">
							<img src="'.$video_thumb[0]["thumbnail_large"].'" width="100%" style="margin: 24px 0;" />
							<div class="settings">
								<ul>
									<li class="modal" modal-title="'.$row->video_name.'" modal-type="vimeo" modal-data="'.$video_id.'">Ansehen</li>
									<li><form methode="post" form-type="confirm" form-message="Wollen Sie das Video wirklich löschen?" form-url="/ajax/multimedia/delete_video/" form-redirect="/"><input type="hidden" value="'.$row->video_id.'" name="id" /><span id="submit">Löschen</span></form></li>
								</ul>
							</div>
						</div>
					</div>
				</div>';
		break;
		
		default:
			# code...
			break;
	}
	
}
?>
