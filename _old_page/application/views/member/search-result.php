<?php 
	foreach ($members as $row) { 
?>
	<tr class="member">
		<td class="name">
			<a href="/member/<?= $row->member_id ?>/profile">
				<img src="<?= $this->M_account_model->get_profile_picture($resource_url, $row->member_profile_image, $row->gender_id) ?>">
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
<?php 
	} 
?>