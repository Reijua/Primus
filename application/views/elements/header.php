<?php if (!isset($page)) $page = ''; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" context="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<meta name="description" content="Primus Romulus besteht ausschließlich aus HTBLA Kaindorf Absolventen. Wir bieten unseren Mitgliedern Jobangebote, Events und die Möglichkeit zu Netzwerken.">

		<meta name="keywords" content="primus romulus,htbla kaindorf absolventen,pr,absolventen,htl kaindorf">

		<link href="<?= asset_url('images/logo/medium_bg.png') ?>" rel="icon" type="image/png" >

		<title><?= $title ?></title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
		<link href="<?= asset_url('css/spinner.css') ?>" rel="stylesheet">
		<link href="<?= asset_url('css/font-awesome.min.css') ?>" rel="stylesheet">
		<link href="<?= asset_url('css/app.min.css') ?>" rel="stylesheet">
		<?php /* <link href="<?= asset_url('less/app.less') ?>" rel="stylesheet/less"> */ ?>

		<script src="<?= asset_url('js/jquery.min.js') ?>"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=true&language=de"></script>
		<script src="<?= asset_url('js/moment-with-locales.min.js') ?>"></script>
		<script src="<?= asset_url('js/bootstrap.min.js') ?>"></script>
		<?php /* <script src="<?= asset_url('js/less.min.js') ?>"></script> */ ?>
		<script src="<?= asset_url('js/bootstrap-datetimepicker.min.js') ?>"></script>
		<script src="<?= asset_url('js/jquery.waypoints.min.js') ?>"></script>
		<script src="<?= asset_url('js/inview.min.js') ?>"></script>
		<script src="<?= asset_url('js/app.js') ?>"></script>
		<script src="<?= asset_url('js/sidebar.js') ?>"></script>
	</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-scrolled-top <?= ($page == 'home' ? 'navbar-home' : '') ?>">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#pr-navbar" aria-expanded="false" style="margin-top: 7px; margin-bottom: 7px;">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= asset_url('images/logo/medium.png') ?>"></a>
			<a class="navbar-brand" href="<?= base_url() ?>">Primus Romulus</a>
		</div>

		<div class="collapse navbar-collapse" id="pr-navbar">
			<ul class="nav navbar-nav navbar-right">				
				<li <?= ($page == 'home' ? 'class="active"' : '') ?>><a href="/home"><?= lang('elements_header_home') ?></a></li>
				<li <?= ($page == 'about' ? 'class="active"' : '') ?>><a href="/about"><?= lang('elements_header_about') ?></a></li>
				<li <?= ($page == 'member' ? 'class="active"' : '') ?>><a href="/member"><?= lang('elements_header_member') ?></a></li>
				<li <?= ($page == 'partner' ? 'class="active"' : '') ?>><a href="/partner"><?= lang('elements_header_partner') ?></a></li>
				<li <?= ($page == 'contact' ? 'class="active"' : '') ?>><a href="/contact"><?= lang('elements_header_contact') ?></a></li>
				<li <?= ($page == 'imprint' ? 'class="active"' : '') ?>><a href="/imprint"><?= lang('elements_header_imprint') ?></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<?php

if ($page != 'home') {
	echo '<div id="padder"></div>';
}

?>