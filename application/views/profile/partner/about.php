<div class="container <?php if(!empty($company_website) || !empty($company_facebook) || !empty($company_google_plus) || !empty($company_linkedin) || !empty($company_twitter) || !empty($company_xing) || !empty($company_youtube)) echo "navbar-margin"; ?>">
	<h2><?= $company_name ?></h2>
	<div class="row" style="margin-bottom: 30px">
		<div class="col-md-8 col-sm-6">
			<p><?= $company_description ?></p>
		</div>
		<div class="col-md-4 col-sm-6">
			<?php foreach($this->Partner->get_partner_sectors($company_id)->result() as $i => $row): ?>
			<i class="fa fa-cube fa-fw"></i> <?= $row->sector ?><br />
			<?php endforeach; ?>
		</div>
	</div>
</div>