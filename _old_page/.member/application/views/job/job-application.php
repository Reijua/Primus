<section></section>
<script type="text/javascript">
	
	$(document).ready(function(){
		$(this).initComponents();
	});
</script>
<div class="blue-line">
	<img src="<?php echo $resource_url; ?>image/website.png" style="position:absolute; bottom:0px; width:100%;">
</div>
<div id="content-wrapper">
	<div id="content-holder" class="white">
		<div class="column-1" style="margin:0 1%; padding:0 1%;">
			<h1>Bewerbung als ...</h1>
		</div>
		<div class="column-2">
			<h3>Persönliche Daten</h3>
			<table width="100%" cellspacing="1" cellpadding="1">
				<tr>
					<td width="50%">
						<label>Anrede</label>
						<select class="select-box">
							<option>Anrede auswählen...</option>
							<option>adsf</option>
						</select>
					</td>
					<td width="50%">
						<label>Titel</label>
						<input type="title">
					</td>
				</tr>
			</table>			
			<label>Vorname</label>
			<input type="text">
			<label>Nachname</label>
			<input type="text">
			<label>Adresse</label>
			<input type="text">
			<table width="100%" cellpadding="1" cellspacing="1">
				<tr>
					<td width="35%">
						<label>PLZ</label>
						<input type="text">
					</td>
					<td width="65%">
						<label>Ort</label>
						<input type="text">
					</td>
				</tr>
			</table>
			<label>Telefon</label>
			<input type="text">
			<label>E-Mail-Adresse</label>
			<input type="text">
			<label>Geburtsdatum</label>
			<input type="text">
		</div>
		<div class="column-2">
			<h3>Schulische Laufbahn</h3>
			<label>Von</label>
			<label>Bis</label>
			<label>Bezeichnung</label>			
			<h3>Berufliche Laufbahn</h3>
			<label>Von</label>
			<label>Bis</label>
			<label>Beruf</label>
		</div>
		<div class="column" style="width:100%;"></div>
		<div class="column" style="width:96%;margin: 0 1%;padding: 0 1%;">
			<h3>Fähigkeiten und Kenntnisse</h3>
		</div>
		<div class="column-2">
			<h4>l</h4>
			<input >
			<h4>Führerscheinklassen</h4>
			<input type="text">

		</div>
	</div>
</div>