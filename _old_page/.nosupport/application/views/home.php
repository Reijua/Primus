<div class="container light-grey">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1 text-center">
			<div class="column-content">
				<h1>Browser aktualisieren</h1>
				<div class="container-description">Damit Sie unsere Website mit allen Features nutzen können müssen Sie Ihren Browser updaten.</div>
			</div>
		</div>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container white">
	<div class="container-content">
		<div class="arrow light-grey"></div>
		<div class="column-1 text-center">
			<div class="column-content">
				<h1>Browser auswählen</h1>
				<div class="container-description">Wählen Sie Ihren Browser aus und befolgen Sie die Schritte. Sollte Ihr Browser nicht vorhanden sein, dann wählen Sie bitte einen anderen aus und installieren diesen.</div>
			</div>
		</div>
		<div class="column-3 text-center">
			<div class="column-content">
				<div class="section-item">
					<div class="section-content" style="background-color: #F5F5F5;">
						<img src="<?php echo $resource_url; ?>image/browser/firefox.png" style="width: 100px; height: 100px; margin:50px 0 50px 0;">
						<h5>Firefox</h5>
						<br />
						<br />
						<strong>VERFÜGBAR FÜR</strong><br />
						<br />
						<img src="<?php echo $resource_url; ?>image/os/windows.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/linux.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/apple.png" style="width:15px; height:15px; margin: 0 5px;"><br />
						<br />
					</div>
					<a href="<?=( $this->agent->browser() != "Firefox" ? "https://www.mozilla.org/de/firefox/new/" : "https://support.mozilla.org/de/kb/firefox-auf-die-letzte-version-aktualisieren") ?>" class="section-hover">
						<table>
							<tr>
								<td><?=( $this->agent->browser() != "Firefox" ? "Download" : "Aktualisieren") ?></td>
							</tr>
						</table>
					</a>
				</div>
			</div>
		</div>
		<div class="column-3 text-center">
			<div class="column-content">
				<div class="section-item" style="background-color: #F5F5F5;">
					<div class="section-content">
						<img src="<?php echo $resource_url; ?>image/browser/chrome.png" style="width: 100px; height: 100px; margin:50px 0 50px 0;">
						<h5>Google Chrome</h5>
						<br />
						<br />
						<strong>VERFÜGBAR FÜR</strong><br />
						<br />
						<img src="<?php echo $resource_url; ?>image/os/windows.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/linux.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/apple.png" style="width:15px; height:15px; margin: 0 5px;"><br />
						<br />
					</div>
					<a href="<?=( $this->agent->browser() != "Chrome" ? "https://www.google.de/chrome/browser/desktop/" : "https://support.google.com/chrome/answer/95414?hl=de") ?>" class="section-hover">
						<table>
							<tr>

								<td><?=( $this->agent->browser() != "Chrome" ? "Download" : "Aktualisieren") ?></td>
							</tr>
						</table>
					</a>
				</div>
			</div>
		</div>
		<?php if(($this->agent->is_browser("IE") || $this->agent->is_browser("Internet Explorer"))){ ?>
		<div class="column-3 text-center">
			<div class="column-content">
				<div class="section-item" style="background-color: #F5F5F5;">
					<div class="section-content">
						<img src="<?php echo $resource_url; ?>image/browser/ie.png" style="width: 100px; height: 100px; margin:50px 0 50px 0;">
						<h5>Internet Explorer</h5>
						<br />
						<br />
						<strong>VERFÜGBAR FÜR</strong><br />
						<br />
						<img src="<?php echo $resource_url; ?>image/os/windows.png" style="width:15px; height:15px; margin: 0 5px;"><br />
						<br />
					</div>
					<a href="http://windows.microsoft.com/de-at/internet-explorer/download-ie" class="section-hover">
						<table>
							<tr>
								<td>Aktualisieren</td>
							</tr>
						</table>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>	
		<div class="column-3 text-center">
			<div class="column-content">
				<div class="section-item" style="background-color: #F5F5F5;">
					<div class="section-content">
						<img src="<?php echo $resource_url; ?>image/browser/opera.png" style="width: 100px; height: 100px; margin:50px 0 50px 0;">
						<h5>Opera</h5>
						<br />
						<br />
						<strong>VERFÜGBAR FÜR</strong><br />
						<br />
						<img src="<?php echo $resource_url; ?>image/os/windows.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/linux.png" style="width:15px; height:15px; margin: 0 5px;"><img src="<?php echo $resource_url; ?>image/os/apple.png" style="width:15px; height:15px; margin: 0 5px;"><br />
						<br />
					</div>
					<a href="<?=( $this->agent->browser() != "Opera" ? "http://www.opera.com/de" : "http://help.opera.com/Linux/10.60/de/autoupdate.html") ?>" class="section-hover">
						<table>
							<tr>
								<td><?=( $this->agent->browser() != "Opera" ? "Download" : "Aktualisieren") ?></td>
							</tr>
						</table>
					</a>
				</div>
			</div>
		</div>
		<?php if($this->agent->is_browser("Safari")){ ?>
		<div class="column-3 text-center">
			<div class="column-content">
				<div class="section-item" style="background-color: #F5F5F5;">
					<div class="section-content">
						<img src="<?php echo $resource_url; ?>image/browser/safari.png" style="width: 100px; height: 100px; margin:50px 0 50px 0;">
						<h5>Safari</h5>
						<br />
						<br />
						<strong>VERFÜGBAR FÜR</strong><br />
						<br />
						<img src="<?php echo $resource_url; ?>image/os/apple.png" style="width:15px; height:15px; margin: 0 5px;"><br />
						<br />
					</div>

					<a href="https://support.apple.com/de-at/HT201541" class="section-hover">
						<table>
							<tr>
								<td>Aktualisieren</td>
							</tr>
						</table>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>
