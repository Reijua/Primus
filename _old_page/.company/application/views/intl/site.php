<section></section>
<script type="text/javascript">
	
	$(document).ready(function(){
		$(this).initComponents();
	});
</script>
<div class="blue-line">
	<img src="<?php echo $resource_url; ?>image/website.png" style="position:absolute; bottom:0px; width:100%;">
</div>
<div id="content-wrapper" class="white">
	<div id="content-holder">
		<div class="nav-breadcrumbs light-gray">
			<ul>
				<li><a href="<?php echo $base_url; ?>"><i class="icon-home"></i></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><a href="/site/<?php echo $site_row->category_tag;  ?>/"><?php echo $site_row->category_name; ?></a> </li>
				<li><i class="icon-angle-right"></i></li>
				<li><?php echo $site_row->site_title; ?></li>
			</ul>
		</div>
		<article>
			<h1><?php echo $site_row->site_title; ?></h1>
			<?php echo $site_row->site_content; ?>
		</article>
	</div>
</div>