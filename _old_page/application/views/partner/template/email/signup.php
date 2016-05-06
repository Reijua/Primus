<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">
		<style type="text/css">
			@media screen and (max-width: 700px){
				.container{
					width: 100% !important;
				}
			}			
		</style>
	</head>
	<body style="background-color:#F5F5F5; padding:0; margin:0; color:#666666;">
		<table class="container" style="width: 700px; border-collapse:0; border-spacing:0; margin: 50px auto;">
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
								Wir freuen uns sehr, dass Du Interesse an Primus Romulus hast! Wie Du sicherlich weißt, sind wir ein Verein für Absolventen der HTBLA Kaindorf und versuchen Dir Vorteile zu schaffen.<br />
								<br />
								In erster Linie versucht Primus Romulus ein einzigartiges Netzwerk zu schaffen, dass Dir in beruflicher Hinsicht als auch privat von Nutzen sein kann. Wir versuchen ständig neue Top-Unternehmen als Partner zu gewinnen, damit wir Dir und anderen Mitgliedern eine große Auswahl an Stellenangeboten bieten können. Überdies wollen wir Deine Interessen und Vorstellungen in verschiedenen Veranstaltungen widerspiegeln.<br />
								<br />
								Damit Du den Zugang zu Deinem Konto erlangst, öffne den Link im nächsten Abschnitt und lege Dein Passwort fest!<br />
								<br />
								<a href="http://member.primus-romulus.net/signup/?code=<?php echo $object_account->member_password_hash; ?>&email=<?php echo $object_account->member_email; ?>">http://member.primus-romulus.net/signup/?code=<?php echo $object_account->member_password_hash; ?>&email=<?php echo $object_account->member_email; ?></a><br />
								<br />
								Wir möchten Dich im Verein herzlich willkommen heißen und sehen uns hoffentlich beim nächsten Event!<br />
								Solltest Du Dich nicht anmelden können, wende dich bitte per E-Mail an <a href="mailto:support@primus-romulus.net" style="color: #0099CC; text-decoration:none;">support@primus-romulus.net</a>.<br />
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