<style type="text/css">
	/*****************/
	/* Post-Feed (s) */
	/*****************/

	.post-feed .post {
		background: #fff;
		margin-bottom: 20px;
		padding: 10px;
		color: #000;
		position: relative;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.post-feed .post .header {
		border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		margin: 0 0 10px;
		padding: 5px 0 10px 0;
		position: relative;
	}

	.post-feed .post .header .title {
		font-size: 22px;
		line-height: 20px;
		font-weight: 400;
		display: inline-block;
	}

	.post-feed .post .header .date {
		position: absolute;
		bottom: 10px;
		right: 0px;
	}

	.post-feed .post .intro-image {
		height: 200px; 
		width: 200px; 
		display: inline-block;
	}

	.post-feed .post .content {
		display: inline-block;
		vertical-align: top;
		margin-left: 5px;
	}

	/*****************/
	/* Post-Feed (e) */
	/*****************/
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>

<div class="application-header">
	<div class="application-headline">
		<h3>Feed</h3>
	</div>
	<div class="application-options">
		<ul>
			<li>
				<button class="modal" data-title="Posten" data-type="url" data-source="/ajax/modal/create_feedpost/">
					Posten
				</button>
			</li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<?php if ($this->Feed_Model->get_feedposts()->num_rows() != 0) { ?>
			<div class="section">
				<div class="post-feed">
				<?php
					foreach ($this->Feed_Model->get_feedposts()->result() as $row) {
				?>

						<div class="post">
							<div class="header">
								<div class="title"><?= $row->company_name ?></div>
								<div class="date"><?= $row->date_added ?></div>
							</div>
						<?php if ($row->image_url != NULL) { ?>
							<div class="intro-image squared-image large border" style="background: url('<?= $row->image_url ?>') 50% 50% no-repeat"></div>
						<?php } ?>
							<div class="content">
							<?= $row->text ?>
							</div>
						</div>

				<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>