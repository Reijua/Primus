<nav class="navbar navbar-default navbar-fixed-top navbar-scrolled-top navbar-second">

	<div class="container">

		<div class="collapse-header">

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#pr-navbar-sec" aria-expanded="false" style="margin-top: 7px; margin-bottom: 7px;">

				<span class="sr-only">Toggle navigation</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

			</button>

			Absolventen-Bereich

		</div>

		<div class="collapse navbar-collapse" id="pr-navbar-sec" aria-expanded="false">

			<ul class="nav navbar-nav">

				<?php if (!isset($subpage)) $subpage = ''; ?>

				
				<li <?= ($subpage == 'feed' ? 'class="active"' : '') ?>><a href="/member/feed"><?= lang('member_header_feed') ?></a></li>

				<li <?= ($subpage == 'jobs' ? 'class="active"' : '') ?>><a href="/member/jobs"><?= lang('member_header_jobs') ?></a></li>

				<li <?= ($subpage == 'partners' ? 'class="active"' : '') ?>><a href="/member/partners"><?= lang('member_header_partners') ?></a></li>

				<li <?= ($subpage == 'members' ? 'class="active"' : '') ?>><a href="/member/members"><?= lang('member_header_members') ?></a></li>

				<li <?= ($subpage == 'polls' ? 'class="active"' : '') ?>><a href="/member/polls"><?= lang('member_header_polls') ?></a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">

				<?php /* <li <?= ($subpage == 'profile' ? 'class="active"' : '') ?>><a href="/member/profile"><?= lang('member_header_profile') ?></a></li> */ ?>

				<li <?= ($subpage == 'messages' ? 'class="active"' : '') ?>>

					<a href="/member/messages">

						<?= lang('member_header_messages') ?> 

						<?= ($this->Message->count_unread_messages($this->session->member['user_id']) == 0 ? '' : '<span class="badge">'. $this->Message->count_unread_messages($this->session->member['user_id']) .'</span>') ?>

					</a>

				</li>

				<li <?= ($subpage == 'settings' ? 'class="active"' : '') ?>><a href="/member/settings"><?= lang('member_header_settings') ?></a></li>

				<li><a href="/member/logout"><?= lang('auth_logout_button') ?></a></li>

			</ul>

		</div>

	</div>

</nav>