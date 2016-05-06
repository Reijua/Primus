<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>
<div class="application-header">
	<div class="application-headline"><h3>Kontaktpersonen</h3></div>
	<div class="application-options">
		<ul>
			<li><button class="modal" data-title="Kontaktperson hinzufügen" data-type="url" data-source="/ajax/modal/create_contact/">Hinzufügen</button></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<?php $v_contact_counter = 1; ?>
	<?php foreach ($this->Account_Model->get_contact($object_account->company_id, "all")->result() as $row) { ?>
	<div class="column-3">
		<div class="column-content">
			<div class="section-item">
				<div class="section-content">
					<div class="text-center">
						<img class="circle-image large" src="<?=$this->Account_Model->get_contact_portrait($resource_url, $row->company_id, $row->contact_id, $row->gender_id) ?>" alt="<?=$row->contact_firstname; ?> <?=$row->contact_lastname; ?>" />
					</div>
					<hr />
					<?=$this->lang->line("gender_title_".$row->gender_description)?><br />
					<?=$row->contact_firstname?> <?=$row->contact_lastname?><br />
					<br />
					<?php if ($row->contact_email != ""){ ?><i class="icon-envelope" style="width: 25px; margin-right: 5px;"></i><?=$row->contact_email?><br /><?php } ?>
					<?php if ($row->contact_phone != ""){ ?><i class="icon-phone" style="width: 25px; margin-right: 5px;"></i><?=$row->contact_phone?><br /><?php } ?>
					<?php if ($row->contact_fax != ""){ ?><i class="icon-print" style="width: 25px; margin-right: 5px;"></i><?=$row->contact_fax?><br /><?php } ?>
				</div>
				<div class="section-footer">
					<table>
						<tr>
							<td style="width:49%; padding-right:1%;"><button class="modal" data-title="Kontaktperson bearbeiten" data-type="url" data-source="/ajax/modal/edit_contact/<?=$row->contact_id; ?>">Bearbeiten</button></td>
							<td style="width:49%; padding-left:1%;"><form data-url="/ajax/contact/delete_contact/<?=$row->contact_id;?>" data-type="confirm" data-text="Wollen Sie diese Kontaktperson wirklich löschen?" data-redirect="/"><button class="submit">Löschen</button></form></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php if($v_contact_counter%3==0){ ?><div class="column-1"></div><?php } ?>
	<?php $v_contact_counter++; ?>
	<?php } ?>
</div>