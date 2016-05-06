<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">
<title>Kontaktformular - {firstname} {lastname}</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
</head>
<body style="font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857; color: #333; background-image: url('http://www.primus-romulus.net/assets/images/layout/background/clean_paper_light.png'); background-attachment: scroll; background-repeat: repeat; background-color: #f2f2f2; background-position: 0% 0%; padding: 30px;" bgcolor="#f2f2f2">
	<div style="width: 640px; border-radius: 10px; background-color: #fff; margin: 0 auto; padding: 0 15px 15px; border: 1px solid #ddd; box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.05);">
		<div style="margin-bottom: 20px; border-bottom-color: #f1f1f1; border-bottom-width: 1px; border-bottom-style: solid; padding: 15px;">
			<a href="<?= base_url() ?>" target="_blank" style="text-decoration: none; color: inherit;">
				<img src="<?= asset_url('images/logo/medium.png') ?>" style="display: inline-block; width: 48px; height: 48px; vertical-align: middle;"><div style="display: inline-block; font-size: 26px; font-weight: 700; color: #555; vertical-align: middle; margin-left: 15px;">Primus Romulus</div>
			</a>
			<div style="float: right; margin-top: 8px;">
				<a href="https://facebook.com/primusromulus/" target="_blank" style="text-decoration: none; color: inherit;">
					<img src="<?= asset_url('images/social/facebook.png') ?>" style="margin-left: 3px;"></a>
				<a href="https://plus.google.com/101535514050835291864" target="_blank" style="text-decoration: none; color: inherit;">
					<img src="<?= asset_url('images/social/googleplus.png') ?>" style="margin-left: 3px;"></a>
				<a href="https://twitter.com/primusromulus/" target="_blank" style="text-decoration: none; color: inherit;">
					<img src="<?= asset_url('images/social/twitter.png') ?>" style="margin-left: 3px;"></a>
			</div>
		</div>
		<div style="padding: 0 10px 10px;">
			<span style="color: #3b5999; font-size: 18px; font-weight: 600; margin-bottom: 20px;">Kontaktformular - {firstname} {lastname}</span><br><br>
			{salutation}<br>
			{firstname} {lastname}<br>
			<a href="mailto:{email}" style="text-decoration: none; color: #3b5999;">{email}</a><br><br>
			hat am {date} um {time} eine Nachricht über das Kontaktformular von Primus Romulus mit folgendem Inhalt gesendet:<br><br>
			<div style="margin-left: 5px; padding-left: 10px; border-left: 2px solid #f1f1f1;">
				{message}
			</div>
		</div>
	</div>
</body>
</html>
