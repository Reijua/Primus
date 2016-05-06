<nav class="navbar navbar-default navbar-fixed-top navbar-scrolled-top navbar-second">
	<div class="container">
		<div class="collapse-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#pr-navbar-sec" aria-expanded="false" style="margin-top: 7px; margin-bottom: 7px;">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			Partner-Bereich
		</div>
		<div class="collapse navbar-collapse" id="pr-navbar-sec" aria-expanded="false">
			<ul class="nav navbar-nav">
				<?php if (!isset($subpage)) $subpage = ''; ?>
				
				<?php if (partner_has_permission('feed')): ?>
					<li <?= ($subpage == 'feed' ? 'class="active"' : '') ?>><a href="/partner/feed"><?= lang('partner_header_feed') ?></a></li>
				<?php endif; ?>

				<?php /* <li <?= ($subpage == 'overview' ? 'class="active"' : '') ?>><a href="/partner/overview"><?= lang('partner_header_overview') ?></a></li> */ ?>

				<li <?= ($subpage == 'contacts' ? 'class="active"' : '') ?>><a href="/partner/contacts"><?= lang('partner_header_contacts') ?></a></li>

				<li <?= ($subpage == 'locations' ? 'class="active"' : '') ?>><a href="/partner/locations"><?= lang('partner_header_locations') ?></a></li>

				<?php if (partner_has_permission('jobs')): ?>
					<li <?= ($subpage == 'jobs' ? 'class="active"' : '') ?>><a href="/partner/jobs"><?= lang('partner_header_jobs') ?></a></li>
				<?php endif; ?>

				<?php /* <li <?= ($subpage == 'products' ? 'class="active"' : '') ?>><a href="/partner/products"><?= lang('partner_header_products') ?></a></li> */ ?>

				<?php if (partner_has_permission('statistics')): ?>
					<li <?= ($subpage == 'statistics' ? 'class="active"' : '') ?>><a href="/partner/statistics"><?= lang('partner_header_statistics') ?></a></li>
				<?php endif; ?>

				<?php /* <li <?= ($subpage == 'bills' ? 'class="active"' : '') ?>><a href="/partner/bills"><?= lang('partner_header_bills') ?></a></li> */ ?>

				<?php if (partner_has_permission('advertisements')): ?>
					<li <?= ($subpage == 'advertisements' ? 'class="active"' : '') ?>><a href="/partner/advertisements"><?= lang('partner_header_advertisements') ?></a></li>
				<?php endif; ?>

				<?php if (partner_has_permission('members')): ?>
					<li <?= ($subpage == 'members' ? 'class="active"' : '') ?>><a href="/partner/members"><?= lang('partner_header_members') ?></a></li>
				<?php endif; ?>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/profile/partner/<?= $this->session->partner['user_id'] ?>" target="_blank"><?= lang('partner_header_profile') ?></a></li>
				<li <?= ($subpage == 'settings' ? 'class="active"' : '') ?>><a href="/partner/settings"><?= lang('partner_header_settings') ?></a></li>
				<li><a href="/partner/logout"><?= lang('auth_logout_button') ?></a></li>
			</ul>
		</div>
	</div>
</nav>