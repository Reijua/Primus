<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>
<div class="application-header">
	<div class="application-headline"><h3>Standorte</h3></div>
	<div class="application-options">
		<ul>
			<li><button class="modal" data-title="Standort hinzufügen" data-type="url" data-source="/ajax/modal/create_location/">Hinzufügen</button></li>
		</ul>
	</div>
</div>
<?php foreach ($this->Location_Model->get_location($object_account->company_id, "all")->result() as $row) { ?>
<div class="column-2">
	<div class="column-content">
		<div class="section-item">
			<div class="section-header">
				<iframe src="https://www.google.com/maps/?q=<?=str_replace(" ", "+", $row->location_address)?>,+<?=$row->location_pc ?>+<?=str_replace(" ", "+", $row->location_city) ?>,+<?=$row->country_name ?>&z=11&t=m&oe=utf8&f=q&output=embed&s=" width="100%" height="200" frameborder="0"></iframe>
				<table>
					<tr>
						<td><span><?=$row->location_name?></span></td>
					</tr>
				</table>
			</div>
			<div class="section-content">
				<?=$row->location_address?><br />
				<?=$row->location_pc?> <?=$row->location_city?><br />
				<?=$row->country_name?>
			</div>
			<div class="section-footer">
				<table>
					<tr>
						<td><button class="modal" data-title="Standort bearbeiten" data-type="url" data-source="/ajax/modal/edit_location/<?=$row->location_id?>">Bearbeiten</button></td>
						<td><form methode="post" data-url="/ajax/location/delete_location/<?=$row->location_id?>" data-type="normal" data-redirect="/"><button class="submit">Löschen</button></form></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<?php } ?>