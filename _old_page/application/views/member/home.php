<style type="text/css">
	.column[class*="width-"] {
		float: left;
		overflow: hidden;
	}
	.column.width-25 {
		width: 25%;
	}
	.column.width-50 {
		width: 50%;
	}
	.column.width-75 {
		width: 75%;
	}

	/******************/
	/* Event-Feed (s) */
	/******************/

	.event-feed .event {
		background: #ffa;
		margin-bottom: 20px;
		padding: 10px;
		color: #000;
		position: relative;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.event-feed .event:first-child {
		margin-top: 20px;
	}

	.event-feed .event .header {
		border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		margin: 0 0 10px;
		padding: 5px 0 10px 0;
		position: relative;
	}

	.event-feed .event .header .title {
		font-size: 22px;
		line-height: 20px;
		font-weight: 400;
		display: inline-block;
	}

	.event-feed .event .header .date {
		position: absolute;
		bottom: 10px;
		right: 0px;
	}

	/******************/
	/* Event-Feed (e) */
	/******************/

	/****************/
	/* Job-Feed (s) */
	/****************/

	.job-feed a:hover {
		text-decoration: none;
	}

	.job-feed a:hover .job .header .title {
		color: #3B5999;
	}

	.job-feed .job {
		background: #A1BFFF;
		margin-bottom: 20px;
		padding: 10px;
		color: #000;
		position: relative;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.job-feed .job:first-child {
		margin-top: 20px;
	}

	.job-feed .job .header .title {
		font-size: 22px;
		line-height: 20px;
		font-weight: 400;
		transition: color 300ms ease-out 0s;
	}

	.job-feed .job .header .company {
		margin-left: 4px;
	}

	.job-feed .job .header .company:before {
		content: "bei ";
	}

	/****************/
	/* Job-Feed (e) */
	/****************/

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

	.post-feed .post:first-child {
		margin-top: 20px;
	}

	.post-feed .post img {
		width: 32px;
		margin-right: 7px;
	}

	.post-feed .post .header {
		border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		margin: 0 0 10px;
		padding-top: 5px;
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

	/*****************/
	/* Post-Feed (e) */
	/*****************/

	/***************/
	/* Ad-Feed (s) */
	/***************/

	.ad-feed a:hover {
		text-decoration: none;
	}

	.ad-feed a:hover .ad .header {
		color: #3B5999;
		border-bottom: 1px solid #3B5999;
	}

	.ad-feed .ad {
		background: #fff;
		margin-bottom: 20px;
		color: #000;
		padding: 10px;
		position: relative;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.ad-feed .ad:first-child {
		margin-top: 20px;
	}

	.ad-feed .ad .header {
		margin-bottom: 2px;
		padding-bottom: 4px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		transition: border-bottom 300ms ease-out 0s;
	}
	
	.ad-feed .ad img {
		width: 32px;
		margin-right: 7px;
	}

	.ad-feed .ad .company {
		font-size: 10px !important;
		line-height: 8px;
		margin-bottom: 5px;
		color: #777;
	}

	.ad-feed .ad .header .name {
		font-size: 16px;
		line-height: 14px;
		font-weight: 400;
		transition: color 300ms ease-out 0s;
	}	

	/***************/
	/* Ad-Feed (e) */
	/***************/

	/************/
	/* Menu (s) */
	/************/

	.menu {
		list-style-type: none;
		padding-left: 0px;
	}

	.menu li {
		margin-top: 3px;
	}

	.menu li.title {
		text-transform: uppercase;
		font-weight: 400;
		margin-top: 15px;
	}

	.menu li.title:first-child {
		margin-top: 0px;
	}

	.menu li .colleague {
		width: 20%;
		display: inline-block;
		margin-top: 3px;
	}

	.menu li .colleague img {
		border-radius: 100%;
		width: 100%;
		transition: box-shadow 300ms ease-out;
	}

	.menu li .colleague a:hover img {
		box-shadow: 0px 0px 3px 1px rgba(59, 89, 153, 1);
	}

	/************/
	/* Menu (e) */
	/************/
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).initUI();
});
</script>

<?php 

	$account_id = $this->session->userdata('account_id');
	$account = $this->M_account_model->get_account("filter:id", $account_id)->row();

?>

<div class="container light-grey">
	<div class="container-content">
		<div class="column width-25">
			<div class="column-content">
				<ul class="menu">
					<li class="title">Quick Links</li>
					<li>
						<a href="/member/search">
							Absolventen suchen
						</a>
					</li>
					<li>
						<a href="/partner/search">
							Unternehmen entdecken
						</a>
					</li>
					<li>
						<a href="/job/search">
							Jobangebote finden
						</a>
					</li>
					<li class="title">Profil</li>
					<li>
						<a href="/member/<?= $account_id ?>/profile">
							<?= $account->member_firstname .' '. $account->member_lastname ?>
						</a>
					</li>
					<li class="title">Meine Klasse</li>
					<li>
						<?php 
							for ($i = 0; $i < 20; $i++) { 
								$rand = rand(0, 3);

								switch ($rand) {
									case 0:
										$url = '/resource/image/team/juergen-r.png';
										break;
									case 1:
										$url = '/resource/image/team/lukas-k.png';
										break;
									case 2:
										$url = '/resource/image/team/markus-w.png';
										break;
									case 3:
										$url = '/resource/image/team/stefan-w.png';
										break;
								}

						?>

						<div class="colleague">
							<a href="/member/<?= $rand + 1 ?>/profile">
								<img src="<?= $url ?>">
							</a>
						</div>

						<?php } ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="column width-50">
			<div class="column-content">
				<div class="section">
					<div class="event-feed">
						<div class="event">
							<div class="header">
								<div class="title">Eröffnungsevent</div>
								<div class="date">2014-12-17 17:30:00</div>
							</div>
							<div class="content">Ein kleine Präsentation über den Verein.</div>
						</div>
					</div>
				</div>
				<?php if ($this->M_job_model->get_job('all')->num_rows() != 0) { ?>
				<div class="section">
					<div class="job-feed">
					<?php foreach ($this->M_job_model->get_job('all')->result() as $row) { ?>
						<a href="/partner/<?= $row->company_id; ?>/job/<?= $row->job_id; ?>">
							<div class="job">
								<div class="header">
									<span class="title"><?= $row->job_title; ?></span>
									<span class="company"><?= $row->company_name; ?></span>
								</div>
								<div class="content">
									<?= $row->job_preamble; ?>
								</div>
							</div>
						</a>
					<?php } ?>
					</div>
				</div>
				<?php } ?>
				<?php if ($this->M_feed_model->get_feedposts()->num_rows() != 0) { ?>
				<div class="section">
					<div class="post-feed">
					<?php foreach ($this->M_feed_model->get_feedposts()->result() as $row) { ?>
							<div class="post">
								<div class="header">
									<table style="width: 100%">
										<tr>
										<?php if ($this->M_partner_model->get_logo($resource_url, $row->company_id) != "") { ?>
											<td>
												<img src="<?= $this->M_partner_model->get_logo($resource_url, $row->company_id) ?>">
											</td>
										<?php } ?>
											<td style="width: 100%">
												<div class="title"><?= $row->company_name ?></div>
												<div class="date"><?= $row->date_added ?></div>
											</td>
										</tr>
									</table>
								</div>
								<div class="content"><?= $row->text ?></div>
							</div>
					<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="column width-25">
			<div class="column-content">
				<!-- Werbung -->
				<?php if ($this->M_advertisement_model->get_advertisement('all')->num_rows() != 0) { ?>
				<div class="section">
					<div class="ad-feed">
					<?php foreach ($this->M_advertisement_model->get_advertisement('all')->result() as $row) { ?>
						<a href="<?= $row->advertisement_url != NULL ? $row->advertisement_url : '/partner/'. $row->company_id .'/profile' ?>">
							<div class="ad">
								<table cellspacing="0" cellpadding="0" style="width: 100%">
									<tr>
									<?php if ($this->M_partner_model->get_logo($resource_url, $row->company_id) != "") { ?>
										<td>
											<img src="<?= $this->M_partner_model->get_logo($resource_url, $row->company_id) ?>">
										</td>
									<?php } ?>
										<td style="width: 100%">
											<div class="header">
												<div class="name"><?= $row->advertisement_name ?></div>
											</div>
											<div class="company"><?= $row->company_name ?></div>
										</td>
									</tr>
								</table>
								<div class="content"><?= $row->advertisement_description ?></div>
							</div>
						</a>
					<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>