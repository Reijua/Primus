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
		$(this).initMenu();
		<?php if($this->session->userdata('login')){ ?>
		$(this).modal();
		<?php } ?>
		
	});
</script>
</head>
<body>
	<header>
		<?php if($this->session->userdata('login')){ ?>
		<div class="logo">
			<img src="<?php echo $resource_url; ?>image/logo.png" style="height: 17px;" alt="Primus Romulus Logo">
		</div>
		<?php } ?>
		<nav class="menu-bar">
			<ul>
				<?php if($this->session->userdata('login')){ ?>
				<li><img src="<?php echo $this->Account_Model->get_profile_picture($resource_url, $object_account->member_id, $object_account->gender_id); ?>" /><?php echo $object_account->member_firstname; ?> <?php echo strtoupper($object_account->member_lastname); ?></li>
				<li>
					<i class="icon-angle-down" style="margin:0 5px;"></i>
					<div class="sub-menu">
						<ul>
							<li><i class="icon-cogs" style="margin-right: 5px;"></i> Einstellungen</li>
							<li><i class="icon-sign-out"></i> Abmelden</li>
						</ul>
					</div>
				</li>
				<li><i class="icon-align-justify"></i></li>
				<?php } ?>				
			</ul>
		</nav>
	</header>