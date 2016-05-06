<div class="banner" style="background-image: url(<?php echo ( (file_exists(FCPATH.'/resource/image/intl/site/'.$object_site->site_id.'.png') == true) ? $resource_url.'image/intl/site/'.$object_site->site_id.'.png' : ( (file_exists(FCPATH.'/resource/image/intl/site/'.$object_site->site_id.'.jpg') == true) ? $resource_url.'image/intl/site/'.$object_site->site_id.'.jpg' : '' ) ); ?>)"></div>
<div class="container white">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content">
				<h1 style="margin-bottom:20px;"><?php echo $object_site->site_name; ?></h1>
				<?php echo $object_site->site_content; ?>
				<?php echo file_exists(FCPATH.'/resource/image/page/banner/'.$object_site->site_id.'.png')==true ? 'JA' : 'NEIN'; ?>
			</div>
		</div>
		<nav class="breadcrumb">
			<ul>
				<li><a href="/"><i class="icon-home"></i></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><a href="/site/<?php echo $object_site->category_tag; ?>/"><?php echo $object_site->category_name; ?></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><?php echo $object_site->site_name; ?></li>
			</ul>
		</nav>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>