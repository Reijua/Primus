<link href="<?= asset_url('css/magnific-popup.css') ?>" rel="stylesheet">
<script src="<?= asset_url('js/jquery.magnific-popup.min.js') ?>"></script>

<div class="news-details">
	<div class="banner" style="background-image: url('<?= base_url() . $news_banner_image_url ?>')"></div>
	<div class="container">
		<h1><?= $news_title ?></h1>
		<p><?= $news_text ?></p>

		<?php if ($news_image_folder_url != NULL): ?>
		<div class="row gallery">
			<?php 

			$images = glob($news_image_folder_url .'*.{jpg,jpeg,png,gif}', GLOB_BRACE);

			foreach ($images as $i => $image):
				if ($image == $news_banner_image_url) continue;

			?>

			<div class="image-wrapper col-lg-2 col-md-3 col-sm-4 col-xs-6">
				<a href="<?= base_url() . $image ?>">
					<div class="image" style="background-image: url('<?= base_url() . $image ?>')"></div>
					<div class="hover">
						<div class="icon">
							<i class="fa fa-search-plus fa-4x"></i>
						</div>
					</div>
				</a>
			</div>

			<?php endforeach; ?>
		</div>
		<?php endif; ?>

	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('.gallery').magnificPopup({
		delegate: 'a',
		gallery: {
			enabled: true
		},
		type: 'image'
	});
});

</script>