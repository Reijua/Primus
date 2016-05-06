<script type="text/javascript">
alert(window.width;
</script>
<div class="banner">

</div>
<div class="container dark-blue">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1 text-center">
			<div class="column-content">
				<h1>Über uns</h1>
				<div class="container-description">Erfahren Sie mehr über uns.</div>
			</div>
		</div>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container light-grey">
	<div class="container-content">
		<div class="arrow dark-blue"></div>
		<div class="column-1 text-center">
			<div class="column-content">
				<h1>Unser Team</h1>
				<div class="container-description">Lernen Sie das Team von Primus Romulus näher kennen.</div>
			</div>
		</div>
		<div class="column-5">
			<div class="column-content text-center">
				<div class="circle-icon medium">
					<img src="<?php echo $resource_url; ?>image/team/male.png" alt="Christoph B."/>
				</div>
				Christoph <strong>Birchbauer</strong><br />
				<small>Co-Founder</small>
			</div>
		</div>
		<div class="column-5 text-center">
			<div class="column-content">
				<div class="circle-icon medium">
					<img src="<?php echo $resource_url; ?>image/team/lukas-k.png" alt="Lukas K."/>
				</div>
				Lukas <strong>Köppel</strong><br />
				<small>Vice President</small>
			</div>
		</div>
		<div class="column-5 text-center">
			<div class="column-content">
				<div class="circle-icon medium">
					<img src="<?php echo $resource_url; ?>image/team/juergen-r.png" alt="Jürgen R."/>
				</div>
				Jürgen <strong>Reinisch</strong><br />
				<small>President &amp; Co-Founder</small>
			</div>
		</div>
		<div class="column-5 text-center">
			<div class="column-content">
				<div class="circle-icon medium">
					<img src="<?php echo $resource_url; ?>image/team/markus-w.png" alt="Markus W."/>
				</div>
				
				Markus <strong>Wilfling</strong><br />
				<small>Treasurer &amp; Co-Founder</small>
			</div>
		</div>
		<div class="column-5 text-center">
			<div class="column-content">
				<div class="circle-icon medium">
					<img src="<?php echo $resource_url; ?>image/team/stefan-w.png" alt="Stefan W."/>
				</div>
				Stefan <strong>Winter</strong><br />
				<small>Secretary &amp; Co-Founder</small>
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
				<h1>Kontakt</h1>
				<div class="container-description">Sie haben Fragen, wollen uns Feedback geben oder wollen einfach nur "Hallo" sagen? Dann schreiben Sie uns!</div>
			</div>
		</div>
		<form methode="post" data-url="/ajax/general/send_contact_form/" data-redirect="/about-us/" data-type="normal">
			<div class="column-2">
				<div class="column-content">
					<label for="contact_firstname">Vorname</label>
					<input type="text"  id="contact_firstname" name="firstname" />
					<label for="contact_lastname">Nachname</label>
					<input type="text"  id="contact_lastname" name="lastname" />
					<label for="contact_email">E-Mail-Adresse</label>
					<input type="text"  id="contact_email" name="email" />
					<label for="contact_subject">Betreff</label>
					<div class="select-box">
						<select name="subject" id="contact_subject">
							<option value="0">Betreff auswählen...</option>
							<option value="1">Feedback</option>
							<option value="2">Fragen</option>
							<option value="3">Hallo</option>
						</select>
					</div>
				</div>
			</div>
			<div class="column-2">
				<div class="column-content">
					<label for="contact_message">Nachricht</label>
					<textarea id="contact_message" name="message" style="height:156px;"></textarea>
					<button class="submit">Senden</button>
				</div>
			</div>
		</form>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>