<div class="partner-profile">
	<div class="banner" style="background-image: url('<?= base_url() ?>{company_banner_image_url}')">
		<div class="container">
			<div class="wrapper">
				<div class="profile-picture">
					<img src="<?= base_url() ?>{company_profile_image_url}">
				</div>
				<div class="profile-name">
					<h2>{company_name}</h2>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<?php if (!isset($subpage)) $subpage = ''; ?>
				
				<li <?= ($subpage == 'overview' ? 'class="active"' : '') ?>><a href="/profile/partner/{company_id}"><?= lang('profile_partner_navigation_overview') ?></a></li>
				<li <?= ($subpage == 'about' ? 'class="active"' : '') ?>><a href="/profile/partner/{company_id}/about"><?= lang('profile_partner_navigation_about') ?></a></li>
				<li <?= ($subpage == 'jobs' ? 'class="active"' : '') ?>><a href="/profile/partner/{company_id}/jobs"><?= lang('profile_partner_navigation_jobs') ?></a></li>
				<li <?= ($subpage == 'contact' ? 'class="active"' : '') ?>><a href="/profile/partner/{company_id}/contact"><?= lang('profile_partner_navigation_contact') ?></a></li>
				<li <?= ($subpage == 'locations' ? 'class="active"' : '') ?>><a href="/profile/partner/{company_id}/locations"><?= lang('profile_partner_navigation_locations') ?></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="" target="_blank"><i class="fa fa-globe"></i></a></li>
				<li><a href="/profile/partner/<?= $this->session->partner['user_id'] ?>" target="_blank"><i class="fa fa-globe"></i></a></li>
			</ul>
		</div>
	</nav>
</div>