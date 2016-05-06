<div class="partner-profile">
	<div class="banner" style="background-image: url('<?= base_url() . $company_banner_image_url ?>')">
		<div class="container">
			<div class="wrapper-large hidden-sm hidden-xs">
				<div class="profile-picture">
					<img src="<?= base_url() . $company_profile_image_url ?>">
				</div>
				<div class="profile-name">
					<h2><?= $company_name ?></h2>
				</div>
			</div>
			<div class="wrapper-small visible-sm visible-xs">
				<div class="profile-picture">
					<img src="<?= base_url() . $company_profile_image_url ?>">
				</div>
				<div>
					<div class="profile-name">
						<h2><?= $company_name ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav" id="navbar-id">
				<?php if (!isset($subpage)) $subpage = ''; ?>
				
				<li <?= ($subpage == 'overview' ? 'class="active"' : '') ?>><a href="/profile/partner/<?= $company_id ?>"><?= lang('profile_partner_navigation_overview') ?></a></li>
				<li <?= ($subpage == 'about' ? 'class="active"' : '') ?>><a href="/profile/partner/<?= $company_id ?>/about"><?= lang('profile_partner_navigation_about') ?></a></li>
				<li <?= ($subpage == 'jobs' ? 'class="active"' : '') ?>><a href="/profile/partner/<?= $company_id ?>/jobs"><?= lang('profile_partner_navigation_jobs') ?></a></li>
				<li <?= ($subpage == 'locations' ? 'class="active"' : '') ?>><a href="/profile/partner/<?= $company_id ?>/locations"><?= lang('profile_partner_navigation_locations') ?></a></li>
				<li <?= ($subpage == 'contact' ? 'class="active"' : '') ?>><a href="/profile/partner/<?= $company_id ?>/contact"><?= lang('profile_partner_navigation_contact') ?></a></li>
			</ul>
			<ul id="navbar-hide-for-sidebar" class="nav navbar-nav navbar-right">
				<?php if (!empty($company_website)): ?><li><a href="<?= prep_url($company_website) ?>" target="_blank"><i class="fa fa-globe"></i></a></li><?php endif; ?>
				<?php if (!empty($company_facebook)): ?><li><a href="<?= prep_url($company_facebook) ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
				<?php if (!empty($company_google_plus)): ?><li><a href="<?= prep_url($company_google_plus) ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
				<?php if (!empty($company_linkedin)): ?><li><a href="<?= prep_url($company_linkedin) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
				<?php if (!empty($company_twitter)): ?><li><a href="<?= prep_url($company_twitter) ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
				<?php if (!empty($company_xing)): ?><li><a href="<?= prep_url($company_xing) ?>" target="_blank"><i class="fa fa-xing"></i></a></li><?php endif; ?>
				<?php if (!empty($company_youtube)): ?><li><a href="<?= prep_url($company_youtube) ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
			</ul>
		</div>
	</nav>
</div>
<?php if(!empty($company_website) || !empty($company_facebook) || !empty($company_google_plus) || !empty($company_linkedin) || !empty($company_twitter) || !empty($company_xing) || !empty($company_youtube)): ?>
<div class="navbar-side-box" id="navbar-side-box">
	<ul class="navbar-side">
		<?php if (!empty($company_website)): ?><li><a href="<?= prep_url($company_website) ?>" target="_blank"><i class="fa fa-globe"></i></a></li><?php endif; ?>
		<?php if (!empty($company_facebook)): ?><li><a href="<?= prep_url($company_facebook) ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
		<?php if (!empty($company_google_plus)): ?><li><a href="<?= prep_url($company_google_plus) ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
		<?php if (!empty($company_linkedin)): ?><li><a href="<?= prep_url($company_linkedin) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
		<?php if (!empty($company_twitter)): ?><li><a href="<?= prep_url($company_twitter) ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
		<?php if (!empty($company_xing)): ?><li><a href="<?= prep_url($company_xing) ?>" target="_blank"><i class="fa fa-xing"></i></a></li><?php endif; ?>
		<?php if (!empty($company_youtube)): ?><li><a href="<?= prep_url($company_youtube) ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
	</ul>
</div>
<?php endif; ?>