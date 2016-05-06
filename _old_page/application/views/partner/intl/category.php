<section>
</section>

<div class="blue-line">
	<img src="<?php echo $resource_url; ?>image/website.png" style="position:absolute; bottom:0px; width:100%;">
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(this).initComponents();
	});
</script>
<div id="content-wrapper">
	<div id="content-holder">
		<div class="column-1 text-center">
			<h1><?php echo $category_row->category_name; ?></h1>
			<?php echo $category_row->category_description; ?>
		</div>
		<?php
		$counter=0;
		foreach ($site_array as $row) {
			echo '<div class="site-item">
						<div class="text-center '.($counter%2==0?'blue':'yellow').'" style="padding-top:10px; padding-bottom:10px;">
							<img src="'.$resource_url.'image/icon/'.($counter%2==0?'white':'black').'/'.$row->site_image.'" height="100px" />
						</div>
						<div class="center">
						<h6 style="font-weight:normal;">'.$row->site_title.'</h6>
						'.$row->site_description.'
						</div>
						<div class="bottom">
							<a href="/site/'.$category_row->category_tag.'/'.$row->site_url.'">Weiterlesen</a>
						</div>
				  </div>';

			$counter++;
		} ?>
	</div>
</div>

