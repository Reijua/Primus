<nav class="navbar navbar-default navbar-fixed-top navbar-scrolled-top navbar-second">
	<div class="container">
		<div class="collapse-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#pr-navbar-sec" aria-expanded="false" style="margin-top: 7px; margin-bottom: 7px;">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			Admin-Bereich
		</div>
		<div class="collapse navbar-collapse" id="pr-navbar-sec" aria-expanded="false">
			<ul class="nav navbar-nav">
				<?php if (!isset($subpage)) $subpage = ''; ?>
				<li <?= ($subpage == 'newsletter' ? 'class="active"' : '') ?>><a href="/admin/newsletter">Newsletter</a></li>
				<li class="dropdown" <?= ($subpage == 'memberfunction' ? 'class="active"' : '') ?>>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Memberfunktionen <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/admin/memberfunction">Zu aktivieren</a></li>
						<li><a href="/admin/memberfunction/allmember">Alle Member</a></li>
						<li><a href="/admin/memberfunction/allbanned">Alle Gebannten</a></li>
					</ul>
		        </li>
				<li <?= ($subpage == 'createpartner' ? 'class="active"' : '') ?>><a href="/admin/partnerfunction">Partnerfunktionen</a></li>
				<li <?= ($subpage == 'event' ? 'class="active"' : '') ?>><a href="/admin/event">Events</a></li>
				<li <?= ($subpage == 'news' ? 'class="active"' : '') ?>><a href="/admin/news">News</a></li>
				<li><a href="/admin/logout">Ausloggen</a></li>
			</ul>
		</div>
	</div>
</nav>