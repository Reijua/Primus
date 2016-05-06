<script type="text/javascript">
$(document).ready(function () {
	$(this).modal();
	$(this).initFormSystem();
});
</script>
<div class="application-header">
	<div class="application-headline">Gallerie</div>
	<div class="application-option">
		<ul>
			<li><span class="link modal" data-title="Gallerie erstellen" data-type="url" data-source="/ajax/modal/create_gallery/">Hinzufügen</span></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<?php
	$this->load->helper("directory");
	foreach ($this->Gallery_Model->get_gallery()->result() as $row) {
	$v_images = directory_map(FCPATH.'../resource/image/gallery/'.$row->gallery_id.'/', true);
	$v_random_image = rand(0,count($v_images)-1);
	echo '<div class="column-4">
			<div class="column-content">
				<div class="section-item">
					<div class="section-header" style="height:200px; background-color: #FFFFFF; background-image: url('.$cdn_url.'image/gallery/'.$row->gallery_id.'/'.$v_images[$v_random_image].');">
						<table style="height:100%; width:100%;">
							<tr>
								<td class="text-center"><span style="background-color:#3B5999; color: #FFFFFF; padding: 10px;">'.$row->gallery_name.'</span></td>
							</tr>
						</table>
					</div>
					<div class="section-footer">
						<table style="width:100%; border-collapse:0; border-spacing:0;">
							<tr>
								<td style="width: 49%; padding-right: 1%;"><button class="modal" data-title="Gallerie bearbeiten" data-type="url" data-source="/ajax/modal/edit_gallery/'.$row->gallery_id.'">Bearbeiten</button></td>
								<td style="width: 49%; padding-left: 1%;"><form methode="post" data-type="confirm" data-text="Wollen Sie diese Gallerie vollständig entfernen?" data-url="/ajax/gallery/delete_gallery/'.$row->gallery_id.'" data-redirect="/" ><button class="submit">Löschen</button></form></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		  </div>';
	} 
	?>
</div>