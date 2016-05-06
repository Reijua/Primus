<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_module ?> - <?php echo $site_name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<?php if(isset($site_description)){ ?><meta name="description" content="<?php echo $site_description; ?>"><?php }else{ ?><meta name="description" content="Primus Romulus besteht ausschließlich aus HTBLA Kaindorf Absolventen. Wir bieten unseren Mitgliedern Jobangebote, Events und die Möglichkeit zu Netzwerken."><?php } ?>
<meta name="keywords" content="primus romulus,htbla kaindorf absolventen,pr,absolventen,htl kaindorf">
<?php if(isset($v_og_type)){ ?><meta property="og:type" content="<?php echo $v_og_type; ?>"><?php } ?>
<?php if(isset($v_og_site_name)){ ?><meta property="og:site_name" content="<?php echo $v_og_site_name; ?>"><?php } ?>
<?php if(isset($v_og_title)){ ?><meta property="og:title" content="<?php echo $v_og_title; ?>"><?php } ?>
<?php if(isset($v_og_description)){ ?><meta property="og:description" content="<?php echo $v_og_description; ?>"><?php } ?>
<?php if(isset($v_og_image)){ ?><meta property="og:image" content="<?php echo $v_og_image; ?>"><?php } ?>
<?php if(isset($v_og_url)){ ?><meta property="og:url" content="<?php echo $v_og_url; ?>"><?php } ?>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
<link href="<?php echo $resource_url; ?>css/framework.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $resource_url; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
		$(this).initFormSystem();
		$(this).initMenu();		
	});
</script>
</head>
<body>
	<header>
		<div class="logo">
			<a href="/">
				<img src="<?php echo $resource_url; ?>image/logo/medium.png" alt="Primus Romulus Logo">
			</a>
		</div>
		<nav>
			<ul>
				<li><i class="icon-align-justify"></i></li>
			</ul>
		</nav>
	</header>