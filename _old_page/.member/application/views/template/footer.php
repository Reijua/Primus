	<?php if(!$this->session->userdata("login")){ ?>
	<footer>
		<img src="<?php echo $resource_url; ?>image/logo.png" alt="Primus Romulus Logo" style="height:20px;" />
	</footer>
	<?php } ?>
	<nav class="menu">
		<div class="menu-header">
			<ul class="option-bar">
				<li><i class="icon-remove"></i></li>
			</ul>
		</div>
		<div class="menu-wrapper">
			<div class="menu-content">
				<?php if($this->session->userdata("login")){ ?>
				<div class="section text-center">
					<img class="circle-image" src="<?php echo ($object_account->member_profile_image != "" ? $object_account->member_profile_image : (($object_account->gender_description == "female") ? $resource_url.'image/profile/female.png' : $resource_url.'image/profile/male.png' )) ?>" alt="Profilbild">
				</div>
				<div class="section">
					<div class="text-center">
						<?php echo $object_account->member_firstname; ?> <?php echo strtoupper($object_account->member_lastname); ?><br />
						<small><?php echo $this->lang->line("group_".str_replace(" ", "_", strtolower($object_account->group_name))); ?></small>
					</div>
					<hr color="#CCCCCC">
					<ul>
						<li class="text-left" style="float:left; width: 50%;"><span class="link grey modal" data-title="Einstellungen" data-type="url" data-source="/ajax/modal/settings/">Einstellungen</span></li>
						<li class="text-right" style="float:left; width: 50%;"><form methode="post" data-url="/ajax/account/logout/" data-redirect="/" data-type="confirm" data-text="Wollen Sie sich wirklich abmelden?"><span class="submit link grey" href="#logout">Abmelden</span></form></li>
					</ul>
				</div>
				<div class="section-divider"></div>
				<?php }else{ ?>
				<div class="section">
					<h6>Menü</h6>
					<ul>
						<li><a href="/">Login</a></li>
						<li><a href="/signup/">Mitglied werden</a></li>
						<li><a href="/support/recovery/">Anmeldedaten vergessen?</a></li>
						<li><a href="http://www.primus-romulus.net/">Zurück zur Startseite</a></li>
					</ul>
				</div>
				<div class="section">
					
					
				</diV>
				<?php } ?>
			</div>
		</div>
	</nav>
	</body>
</html>