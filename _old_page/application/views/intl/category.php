<div class="banner" style="background-image: url(<?php echo $this->Site_Model->get_banner("category", $resource_url, $object_category->category_id) ?>);">
</div>
<div class="container light-grey" >
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1 text-center">
			<div class="column-content">
				<h1><?php echo $object_category->category_name; ?></h1>
				<div class="container-description"><?php echo $object_category->category_description; ?></div>
			</div>
		</div>
		<?php
		foreach ($array_site as $row) {
		echo '	<div class="column-2">
					<div class="column-content">
						<div class="section-item">
							<div class="section-header" style="background-image: url('.$this->Site_Model->get_banner("site", $resource_url, $row->site_id).')"></div>
							<div class="section-content">
								<h4>'.$row->site_name.'</h4>
								'.$row->site_description.'
							</div>
							<a class="section-hover" href="/site/'.$row->category_tag.'/'.$row->site_tag.'/">
								<table>
									<tr>
										<td>Mehr erfahren</td>
									</tr>
								</table>
							</a>
						</div>
					</div>
				</div>';
		}
		?>
		<nav class="breadcrumb">
			<ul>
				<li><a href="/"><i class="icon-home"></i></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><?php echo $object_category->category_name; ?></li>
			</ul>
			
		</div>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow light-grey"></div>
	</div>
</div>

