<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_module ?> - <?php echo $site_name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
<link href="<?php echo $resource_url; ?>css/framework.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $resource_url; ?>css/icon.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $resource_url; ?>css/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
    <script src="<?php echo $resource_url; ?>js/jquery-1.9.0.js"></script>
<![endif]-->
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
    <script src="<?php echo $resource_url; ?>js/jquery-2.0.3.js"></script>
<!--[endif]-->
<script type="text/javascript" src="<?php echo $resource_url; ?>js/framework.js"></script>
<script type="text/javascript" src="<?php echo $resource_url; ?>js/system.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(this).modal();
		$(this).initFormSystem();
		$(this).initMobileMenu();
	});
</script>
</head>
	
<body>
	<header>
		<section>
			<img src="<?php echo $resource_url; ?>image/logo.png" height="<?php if(!$this->session->userdata('login')){ ?>72px<?php }else{ ?>32px<?php } ?>" />
		</section>
		<?php if($this->session->userdata('login')){ ?>
		<nav class="option-bar">
			<ul>
				<li>
					<?php echo $obj_account->company_name; ?> <i class="icon-arrow-down" style="margin: 0 5px;"></i>
					<div class="sub-menu">
						<?php echo $obj_account->company_name; ?><br />
						<small><?php echo $this->lang->line('group_'.strtolower($obj_account->group_name)); ?></small><br />
						<hr color="#CCCCCC">
						<ul>
							<li><a class="modal" modal-title="<?php echo $this->lang->line("template_header_nav_settings"); ?>" modal-type="url" modal-data="/ajax/modal/settings"><?php echo $this->lang->line("template_header_nav_settings");?></a></li>
							<li><form methode="post" form-url="/ajax/account/signout/" form-type="confirm" form-redirect="/" form-message="Wollen Sie sich wirklich abmelden?"><a href="#" id="submit"><?php echo $this->lang->line("template_header_nav_logout");?></a></form></li>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
		<?php }else{ ?>
		<nav class="mobile-bar">
			<ul>
				<li><i class="icon-points"></i></li>
			</ul>
		</nav>
		<nav class="desktop-bar">			
			<ul>
				<li><a href="/">Startseite</a></li>
				<li><a href="/signin/">Login</a></li>
				<li><a href="/signup/">Registrieren</a></li>
				<li>
					<a href="http://primus-romulus.net/site/about-us/">Über uns</a>
					<div class="sub-menu-wrapper">
						<div class="sub-menu-holder">
							<div class="column-4">
								<div class="column-content text-center">
									<a href="http://primus-romulus.net/site/about-us/idea/"><img src="<?php echo $resource_url; ?>image/icon/header/bulb.png" alt="Idea Icon" width="100"></a>
									<a href="http://primus-romulus.net/site/about-us/idea/"><h4>Unsere Idee</h4></a>
									<br />
									Unsere Idee hinter der Plattform.<br />
									<br />
									<a href="http://primus-romulus.net/site/about-us/idea/"><strong>Erfahren Sie mehr!</strong></a>
								</div>
							</div>
							<div class="column-4">
								<div class="column-content text-center">
									<a href="http://primus-romulus.net/site/about-us/about-us/"><img src="<?php echo $resource_url; ?>image/icon/header/group.png" alt="Group Icon" width="100"></a>
									<a href="http://primus-romulus.net/site/about-us/about-us/"><h4>Wer wir sind</h4></a>
									<br />
									Ein kurzer Überblick über den Verein und den wichtigsten Mitgliedern.<br />
									<br />
									<a href="http://primus-romulus.net/site/about-us/about-us/"><strong>Erfahren Sie mehr!</strong></a>
								</div>
							</div>
							<div class="column-4">
								<div class="column-content text-center">
									<a href="http://primus-romulus.net/site/about-us/philosophie/"><img src="<?php echo $resource_url; ?>image/icon/header/tenet.png" alt="Tenet Icon" width="100"></a>
									<a href="http://primus-romulus.net/site/about-us/philosophie/"><h4>Unsere Grundsätze</h4></a>
									<br />
									Erfahren Sie, an was wir glauben!<br />
									<br />
									<a href="http://primus-romulus.net/site/about-us/philosophie/"><strong>Erfahren Sie mehr!</strong></a>
								</div>
							</div>
							<div class="column-4">
								<div class="column-content text-center">
									<a href="http://primus-romulus.net/site/about-us/press/"><img src="<?php echo $resource_url; ?>image/icon/header/press.png" alt="Press Icon" width="100"></a>
									<a href="http://primus-romulus.net/site/about-us/press/"><h4>Presse</h4></a>
									<br />
									Logo, Fotos und vieles mehr für den Artikel über Primus Romolus!<br />
									<br />
									<a href="http://primus-romulus.net/site/about-us/press/"><strong>Erfahren Sie mehr!</strong></a>
								</div>
							</div>
							<div class="column-1"></div>
							<div class="column-4">
								<div class="column-content text-center">
									<a href="http://primus-romulus.net/site/about-us/partner/"><img src="<?php echo $resource_url; ?>image/icon/header/partner.png" alt="Partner Icon" width="100"></a>
									<a href="http://primus-romulus.net/site/about-us/partner/"><h4>Partner</h4></a>
									<br />
									Unsere Partner auf einen Blick!<br />
									<br />
									<a href="http://primus-romulus.net/site/about-us/partner/"><strong>Erfahren Sie mehr!</strong></a>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>			
		</nav>
		<?php } ?>
		
	</header>
	<nav class="mobile-menu">
		<ul>
			<li><a href="/">Startseite</a></li>
			<li><a href="/signin/">Login</a></li>
			<li><a href="/signup/">Registrieren</a></li>			
			<li>
				<div class="menu-placeholder">Über uns <i class="icon-plus"></i></div>
				<ul>
					<li><a href="http://primus-romulus.net/site/about-us/idea">Unsere Idee</a></li>
					<li><a href="http://primus-romulus.net/site/about-us/about-us">Wer wir sind</a></li>
					<li><a href="http://primus-romulus.net/site/about-us/philosophie">Unsere Grundsätze</a></li>
					<li><a href="http://primus-romulus.net/site/about-us/press">Presse</a></li>
					<li><a href="http://primus-romulus.net/site/about-us/partner">Partner</a></li>
				</ul>
			</li>
		</ul>
	</nav>