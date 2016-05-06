<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(this).initFormSystem();
		$(this).accordion();
	});
</script>
<div class="column-1">
	<div class="column-content">
		<h3>Rechnungen</h3>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<table width="100%" class="bill-table" cellpadding="0" cellspacing="0">
			<tr>
				<td>Nr.</td>
				<td>Datum</td>
				<td>Betrag</td>
				<td>Optionen</td>
			</tr>
			<?php
			foreach ($this->Bill_Model->get_bill($this->session->userdata('account_id'))->result() as $row) {
				$sum=0;
				foreach ($this->Bill_Model->get_item_list($this->session->userdata('account_id'), $row->bill_year, $row->bill_id)->result() as $key) {
					$sum = $sum + $key->item_price;
				}
			echo '
			<tr>
				<td width="20%">'.$row->bill_year.''.$row->bill_id.'</td>
				<td>'.$row->bill_fdate.'</td>
				<td>'.number_format($sum, 2, ",", ".").' &euro;</td>
				<td><a href="/ajax/account/bill/'.$row->bill_year.'/'.$row->bill_id.'">Ansehen</a></td>
			</tr>
			';
			}
			?>
		</table>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<h3>Rechnungssupport</h3>
	</div>
</div>
<div class="column-2">
	<div class="column-content">
		<section>
			<div class="accordion">
				<div class="accordion-section">
					<div class="accordion-header">Wann muss die Rechnung spätestens bezahlt werden?<i class="icon-plus"></i></div>
					<div class="accordion-body">
						Die Rechnung muss innerhalb von 30 Tagen bezahlt werden.
					</div>
				</div>
				<div class="accordion-section">
					<div class="accordion-header">An welches Konto muss ich den zu zahlenden Betrag überweisen?<i class="icon-plus"></i></div>
					<div class="accordion-body">
						IBAN: AT90 2081 5000 4024 4592. Wenn Sie eine Überweisung aus dem Ausland tätigen, müssen Sie auch den BIC: STSPAT2GXXX  angeben.
					</div>
				</div>
				<div class="accordion-section">
					<div class="accordion-header">Was ist der Verwendungszweck?<i class="icon-plus"></i></div>
					<div class="accordion-body">
						Mit dem Verwendungszweck wird der Zuweisungsprozess Ihres Paketes zur Rechnung vereinfacht.
					</div>
				</div>
				<div class="accordion-section">
					<div class="accordion-header">Was passiert wenn meine Mitgliedschaft nach einem Jahr abläuft<i class="icon-plus"></i></div>
					<div class="accordion-body">
						Wir weisen Ihnen früh genug auf ein Ende Ihrer Mitgliedschaft hin. Wenn Sie danach weiterhin Teil unseres Netzwerks sein wollen melden Sie sich einfach bei uns und wir werden Ihnen eine neue Rechnung zukommen lassen.
					</div>
				</div>
				<div class="accordion-section">
					<div class="accordion-header">Was passiert, wenn ich ein Upgrade zum nächst Besseren Paket machen möchte?<i class="icon-plus"></i></div>
					<div class="accordion-body">
						Wir bieten leider keine Upgrade Pakete an, weshalb für Sie der gesamte Betrag anfällt. Ihre Mitgliedschaftsdauer wird ab dem Zeitpunkt des neuen Kaufes berechnet.
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<div class="column-4">
	<div class="column-content">
		<div class="contact-thumbnail">
			<div class="image">
				<img src="http://www.primus-romulus.net/resource/image/management/thumb/markus-w.png">
			</div>
			<hr color="#CCCCCC" />
			Herr<br />
			Markus Wilfling</br>
			<small>- Treasurer</small></br>
			</br>
			<i class="icon-envelope"></i> <a href="mailto:m.wilfling@primus-romulus.net">m.wilfling@primus-romulus.net</a>
		</div>
	</div>
</div>