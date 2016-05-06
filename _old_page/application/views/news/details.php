<script type="text/javascript">
$(document).ready(function () {
	$(this).tabs();
	$(this).initGallery();	
})
</script>
<div class="banner" style="background-image: url(<?=$this->News_Model->get_banner($resource_url, $object_news->news_id); ?>);">
</div>
<div class="container white">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content">
				<h1><?php echo $object_news->news_title; ?></h1>
				<?php echo str_replace(array("\n", "\r", "\r\n", "[removed]"), array("<br />", "<br />", "<br />", ""), $object_news->news_text); ?>
			</div>
		</div>
		<?php if(count($array_gallery) > 0){ ?>
		<div class="column-1">
			<div class="column-content">
				<div class="tabs">
					<nav>
						<ul>
							<?php
							foreach ($array_gallery as $row) {
							echo '<li data-tab="gallery-'.$row->gallery_id.'">'.$row->gallery_name.'</li>';
							}
							?>
							
						</ul>
					</nav>
					<div class="content">
						<?php
							foreach ($array_gallery as $row) {
							echo '<div id="gallery-'.$row->gallery_id.'">';
								echo '<div class="gallery">';
									echo '<div class="gallery-content">';
									foreach (directory_map(FCPATH.'resource/image/gallery/'.$row->gallery_id.'/') as $key => $value) {
										echo '	<div class="gallery-item" style="background-image: url('.$resource_url.'image/gallery/'.$row->gallery_id.'/'.$value.');" data-image="'.$resource_url.'image/gallery/'.$row->gallery_id.'/'.$value.'">
													<span class="hover">
														<table>
															<tr>
																<td><i class="icon-search"></i></td>
															</tr>
														</table>
													</span>
												</div>';
									}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							}
							?>
						<div id="gallery-1">

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<nav class="breadcrumb">
			<ul>
				<li><a href="/"><i class="icon-home"></i></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><?php echo $object_news->category_name; ?></li>
				<li><i class="icon-angle-right"></i></li>
				<li><?php echo $object_news->news_title; ?></li>
			</ul>
		</nav>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>