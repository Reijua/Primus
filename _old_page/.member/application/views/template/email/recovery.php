<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
		<style type="text/css">
			@media screen and (max-width: 700px){
				.container{
					width: 100% !important;
				}
			}	
			
		</style>
	</head>
	<body style="background-color:#F5F5F5; padding:0; margin:0; color:#666666;">
		<table class="container" style="width: 700px; border-collapse:0; border-spacing:0; margin: 50px auto; font-size: 15px;">
			<tr>
				<td>
					<table style="width:100%; border-collapse:0; border-spacing:0;">
						<tr>
							<td align="right"><img src="<?=$cdn_url ?>image/logo/medium.png" height="40px" width="40px" style="width:40px; height:40px;"></td>
						</tr>
					</table>
					<table style="width:100%; border-collapse:0; border-spacing:0; margin: 20px 0;  font-family:'Open Sans', Arial, sans-serif; font-weight: 300;">
						<tr>
							<td>
								Hallo <?php echo $object_account->member_firstname; ?>!<br />
								<br />
								Damit du dein Passwort zurücksetzen kannst, öffne den folgenden Link in deinem Browser.<br />
								<br />
								<a href="http://member.primus-romulus.net/support/recovery/?code=<?php echo $object_code; ?>&email=<?php echo $object_account->member_email; ?>"  style="color: #0099CC; text-decoration:none;">http://member.primus-romulus.net/support/recovery/?code=<?php echo $object_code; ?>&amp;email=<?php echo $object_account->member_email; ?></a><br />
								<br />
								Solltest du dich nach der Eingabe deines neuen Passwortes noch immer nicht anmelden können, wende dich bitte per E-Mail an <a href="mailto:support@primus-romulus.net" style="color: #0099CC; text-decoration:none;">support@primus-romulus.net</a>.<br />
								<br />
								Mit freundlichen Grüßen<br />
								<br />
								<br />
								Primus Romulus
							</td>
						</tr>
					</table>
					<table style="width:100%; border-collapse:0; border-spacing:0; border-top: 2px solid #CCCCCC; margin-top: 5px; padding-top: 5px; font-family:'Open Sans', Arial, sans-serif; font-weight: 300;">
						<tr>
							<td align="center" style="text-align:center"><a href="http://www.primus-romulus.net/" style="color: #0099CC; text-decoration:none;">Copyright &copy; <?php echo date('Y') ?> Primus Romulus</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>