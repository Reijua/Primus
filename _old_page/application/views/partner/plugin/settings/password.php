<script type="text/javascript">
$(document).ready(function(){
	$(this).initFormSystem();
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Passwort ändern</h4>
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<strong>Information</strong><br />
		Passwörter sind die erste Verteidigungslinie gegen Cyberkriminelle. Verwenden Sie für jedes Ihrer Konten ein eigenes Passwort, besonders für wichtige Konten wie E-Mail und Onlinebanking. Wenn Sie dasselbe Passwort für jedes Ihrer Online-Konten verwenden, ist das so, als ob Sie den selben Schlüssel zum Abschließen Ihrer Haustür, Ihres Autos und Ihres Büros verwenden würden - gelangt ein Krimineller in den Besitz dieses Schlüssels, kann er damit alle Türen öffnen. Erstellen Sie ein langes Passwort. Je länger das Passwort ist, desto schwerer kann es von anderen erraten werden. Wählen Sie ein Passwort aus einer Kombination von Groß-, Kleinbuchstaben, Zahlen und Sonderzeichen.<br />
		<br />
		Ein gutes Passwort kann man mit einem Satz bilden. Aus diesem Satz bilden Sie dann mithilfe von Groß-, Kleinbuchstaben, Zahlen und Sonderzeichen ein Passwort.<br />
		<br />
		<strong>Beispiel</strong><br />
		Satz: "Christoph und Stefan essen gerne zwei Burger zum Mittagessen."<br /> 
		Passwort: C&amp;Seg2BzM
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<form methode="post" data-url="/ajax/account/password_change/" data-type="normal">
			<label for="password_current">Derzeitiges Passwort</label>
			<input type="password" name="password_current" id="password_current">
			<label for="password_new">Neues Passwort</label>
			<input type="password" name="password_new" id="password_new">
			<label for="password_confirm">Passwort bestätigen</label>
			<input type="password" name="password_confirm" id="password_confirm">
			<button class="submit">Speichern</button>
		</form>
	</div>
</div>