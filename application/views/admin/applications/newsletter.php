<div class="container partner-feed">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/admin/newsletter/create-newsletter">Newsletter erstellen</a>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<th>#</th>
				<th>Datum</th>
				<th>Titel</th>
				<th>Text</th>
				<th>Member</th>
				<th>Partner</th>
				<th>Employee</th>
				<th>Empfänger</th>
				<th class="functions">Funktionen</th>
			</thead>
			<tbody>
				<?php foreach ($this->Newsletter->get_newsletter()->result() as $i => $row): ?>
				
				<tr>
					<td><?= $row->newsletter_id ?></td>
					<td><?= date('d.m.Y H:i', strtotime($row->newsletter_send)) == '01.01.1970 01:00' ? 'nicht gesendet' : date('d.m.Y H:i', strtotime($row->newsletter_send))?></td>
					<td><?= nl2br($row->newsletter_subject) ?></td>
					<td<?php
						if(!function_exists('multiexplode'))
						{
							function multiexplode ($delimiters,$string) 
							{
								$ready = str_replace($delimiters, $delimiters[0], $string);
								$launch = explode($delimiters[0], $ready);
								return  $launch;
							}
						}
						
						
						$words  = multiexplode(array(",",".","|",":","\n","<br>","<br />",":"," ","!","?"),$row->newsletter_text);
						
						$longestWordLength = 0;
						$longestWord = "";
						foreach ($words as $word) 
						{
						   if (strlen($word) > $longestWordLength) 
						   {
							  $longestWordLength = strlen($word);
							  $longestWord = $word;
						   }
						}

						if($longestWordLength > 30)
							echo ' style="word-break: break-all;"';
					?>><?= word_limiter(nl2br($row->newsletter_text), 30) ?></td>
					<td><?= $row->newsletter_to_member == 0 ? 'Nein' : 'Ja' ?></td>
					<td><?= $row->newsletter_to_partner == 0 ? 'Nein' : 'Ja' ?></td>
					<td><?= $row->newsletter_to_employee == 0 ? 'Nein' : 'Ja' ?></td>
					<td><?= $row->newsletter_count_recipients ?></td>
					<td class="functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/admin/newsletter/edit-newsletter/<?= $row->newsletter_id ?>" role="button">Bearbeiten</a>
						<a class="btn btn-danger btn-xs load-modal" data-source="/admin/newsletter/delete-newsletter/<?= $row->newsletter_id ?>" role="button">Löschen</a>
						<a class="btn btn-success btn-xs load-modal" data-source="/admin/newsletter/send-newsletter/<?= $row->newsletter_id ?>" role="button">Senden</a>
					</td>
				</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- TODO: create and edit application, delete and edit model functions, new admin user, method or button to send -->