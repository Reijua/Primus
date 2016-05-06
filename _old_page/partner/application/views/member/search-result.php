<?php if ($members->num_rows() != 0) {  ?>
	<table class="members">
		<tr class="filter">
			<form method="post">
				<td class="name">
					<input type="text" class="filter_name">
				</td>
				<td class="company">
					<select class="filter_company">
						<option value="XALLX">alle</option>
						<option value="1">Primus Romulus e. V.</option>
						<option value="2">C&P Immobilien AG</option>
					</select>
				</td>
				<td class="class">
					<select class="filter_class">
						<option value="XALLX">alle</option>
						<option value="1">2011</option>
						<option value="2">2012</option>
						<option value="3">2013</option>
						<option value="4">2014</option>
						<option value="5">2015</option>
					</select>
				</td>
				<td class="action">
					<button class="filter-button" onclick="filter();">Filtern</button>
				</td>
			</form>
		</tr>
		<tr>
			<th>Absolvent</th>
			<th>Beschäftigt bei</th>
			<th>Jahrgang</th>
			<th>Kontakt</th>
		</tr>
	<?php foreach ($members->result() as $row) { ?>
		<tr class="member">
			<td class="name">
				<a href="/member/<?=  $row->member_id  ?>/profile">
					<img src="<?= $this->Member_Model->get_profile_picture('', $row->member_profile_image, $row->gender_id) ?>">
					<?= $row->member_firstname .' '. $row->member_lastname ?>
				</a>
			</td>
			<td class="company">
				<a href="/partner/1/profile">Primus Romulus e. V.</a>
			</td>
			<td class="class">
				<?= $row->class_name .' / '. $row->class_year ?>
			</td>
			<td class="contact">
				<i class="icon-envelope"></i> <a href="#">Nachricht schreiben</a>
			</td>
		</tr>
	<?php } ?>
	</table>
<?php } ?>