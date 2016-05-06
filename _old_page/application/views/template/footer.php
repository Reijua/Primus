	<footer>
		<div class="footer-top">
			<div class="footer-wrapper">
				<div class="column-4">
					<div class="column-content">
						<h4>Absolventen</h4>
						<ul>
							<li><a href="/member/login">Anmelden</a></li>
							<li><a href="/member/register">Mitglied werden</a></li>
						</ul>
					</div>
				</div>
				<div class="column-4">
					<div class="column-content">
						<h4>Partner</h4>
						<ul>
                            <li><a href="http://partner.primus-romulus.net">Anmelden</a></li>
							<li><a href="/partner/register">Partner werden</a></li>
						</ul>
					</div>
				</div> 
				<div class="column-4">
					<div class="column-content">
						<h4>Social Network</h4>
						<ul>
							<li><a href="https://facebook.com/primusromulus/" target="_blank">Facebook</a></li>
							<li><a href="https://plus.google.com/101535514050835291864" rel="publisher"  target="_blank">Google +</a></li>
							<li><a href="https://twitter.com/primusromulus/" target="_blank">Twitter</a></li>
						</ul>
					</div>
				</div>
				<div class="column-4">
					<div class="column-content">
						<h4>Kontakt</h4>
						<address>
							<strong>Primus Romulus</strong><br />
							<br />
							Hauptstraße 179<br />
							8141 Unterpremstätten<br />
							<br />
							<i class="icon-envelope"></i> <a href="mailto:office@primus-romulus.net">office@primus-romulus.net</a>
						</address>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="footer-wrapper">
				<div class="column text-left" style="width:50%;">
					<div class="column-content" style="margin-top: 0; margin-bottom: 0;">
						&copy; <?php echo date("Y") ?> <?php echo $site_name; ?>
					</div>
				</div>
				<div class="column text-right desktop-visible" style="width:50%;">
					<div class="column-content" style="margin-top: 0; margin-bottom: 0;">
						<a href="/site/legal/imprint/">Impressum</a> | <a href="/site/legal/tos/">Nutzungsbedingung</a> | <a href="/site/legal/gtc/">Datenschutzerklärung</a> | <a href="/site/legal/toc/">Cookie-Richtlinien</a>
					</div>
				</div>
				<div class="column text-right desktop-hidden" style="width:50%;">
					<div class="column-content" style="margin-top: 0; margin-bottom: 0;">
						<a href="/site/legal/">Rechtliches</a>
					</div>
				</div>
			</div>
			
		</div>
	</footer>
	<nav class="menu">
		<div class="menu-header">
			<ul class="option-bar">
				<li><i class="icon-remove"></i></li>
			</ul>
		</div>
		<div class="menu-wrapper" style="height: 746px;">
			<div class="menu-content">
				<?php
					// Zum Testen für Login
					if ($this->session->userdata('login')) {
						$p_account_id = $this->session->userdata('account_id');
						$v_account = $this->M_account_model->get_account("filter:id", $p_account_id)->row();
				?>
					<div class="section" style="margin: 8px 0px 20px;">
						<h6><?= $v_account->member_firstname .' '. $v_account->member_lastname ?></h6>
						<a href="/member/profile/<?= $v_account->member_id ?>">Profil</a>
						<form methode="post" data-url="/ajax/account/logout/" data-redirect="/" data-type="normal">
							<span class="submit link">Abmelden</span>
						</form>
					</div>
				<?php
					} else {
				?>
				<div class="section">
					<h6>Allgemeines</h6>
					<ul>
						<li><a href="/">Startseite</a></li>
						<li><a href="/about/">Über uns</a></li>
					</ul>
				</div>
				<div class="section">
					<h6>Absolventen</h6>
					<ul>
						<li><a href="/member/login">Anmelden</a></li>
						<li><a href="/member/register">Mitglied werden</a></li>
					</ul>
				</div>
				<div class="section">
					<h6>Partner</h6>
					<ul>
						<li><a href="http://partner.primus-romulus.net">Anmelden</a></li>
						<li><a href="/partner/register">Partner werden</a></li>
					</ul>
				</div>
				<?php
					}
				?>
				<div class="section">
					<hr style="color:#CCCCCC;" />
					<ul class="social-network">
						<li><a href="https://facebook.com/primusromulus/" target="_blank"><img src="<?php echo $resource_url; ?>image/icon/social-network/facebook.png" alt="Facebook" /></a></li>
						<li><a href="https://plus.google.com/101535514050835291864" rel="publisher" target="_blank"><img src="<?php echo $resource_url; ?>image/icon/social-network/google_plus.png" alt="Google +" /></a></li>
						<li><a href="https://twitter.com/primusromulus/" target="_blank"><img src="<?php echo $resource_url; ?>image/icon/social-network/twitter.png" alt="Twitter" /></a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	</body>
</html>