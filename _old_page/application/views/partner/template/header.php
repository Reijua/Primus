<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_module ?> - <?php echo $site_name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
<link href="<?php echo $resource_url; ?>css/framework.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $resource_url; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<?php if($this->session->userdata('login')){ ?>
<link href="<?php echo $resource_url; ?>css/style.css" rel="stylesheet" type="text/css" />
<?php }else{ ?>
<link href="<?php echo $resource_url; ?>css/login.css" rel="stylesheet" type="text/css" />
<?php } ?>
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
		$(this).initFormSystem();
		<?php if($this->session->userdata('login')){ ?>
		$(this).initUI();
		$(this).modal();
		<?php }else{ ?>
		$(this).initMenu();
		<?php } ?>
		
	});
</script>
</head>
<body>
	<header>
		<div class="logo">
			<a href="/"><img src="<?php echo $cdn_url; ?>image/logo.png" alt="Primus Romulus Logo"></a>
		</div>
		<nav class="menu-bar">
			<ul>
				<?php if($this->session->userdata('login')){ ?>
				<li>
					<?php echo $object_account->company_name; ?> <i class="icon-angle-down" style="margin:0 5px;"></i>
					<div class="sub-menu">
						<ul>
							<li><span class="modal link" data-title="Einstellungen" data-type="url" data-source="/ajax/modal/settings/">Einstellungen</span></li>
							<li><form methode="post" data-url="/ajax/account/logout/" data-redirect="/" data-type="confirm" data-text="Wollen Sie sich wirklich abmelden?"><span class="submit link">Abmelden</span></form></li>
						</ul>
					</div>
				</li>
				<?php }else{ ?>
				<li><i class="icon-align-justify"></i></li>
				<?php } ?>				
			</ul>
		</nav>
	</header>