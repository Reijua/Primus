<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(this).initFormSystem();
	});
</script>
<div class="column-1">
	<div class="column-content">
		<h3>Kontakt</h3>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Kontakt hinzufügen" modal-type="url" modal-data="/ajax/modal/add_contact/">Hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<?php
foreach ($this->Account_Model->get_contact($this->session->userdata('account_id'))->result() as $row) {
	echo '
	<div class="column-4">
		<div class="column-content">
			<div class="contact-thumbnail">
				<div class="image">
					<img src="'.($row->contact_portrait==""? ( $row->gender_name=="female" ? $resource_url.'image/portrait/female.png' : $resource_url.'image/portrait/male.png') : $row->contact_portrait ).'" />
				</div>
				<hr color="#CCCCCC" />	
				<div>
				'.$this->lang->line('gender_salutation_'.$row->gender_name).'<br />
				'.( $row->contact_title == "" ?'':$row->contact_title.' ').''.$row->contact_firstname.' '.$row->contact_lastname.'<br />
				<small>- '.$row->contact_position.'</small><br />
				<br />
				'.( $row->contact_email == "" ?'':'<i class="icon-envelope"></i> <a href="mailto:'.$row->contact_email.'">'.$row->contact_email.'</a><br />').'
				'.( $row->contact_phone == "" ?'':'<i class="icon-phone"></i> '.$row->contact_phone.'').'
				</div>
				<div class="option-bar">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="49%" style="padding-right:1%;"><button class="modal" modal-title="Kontakt: '.$row->contact_firstname.' '.$row->contact_lastname.'" modal-type="url" modal-data="/ajax/modal/edit_contact/'.$row->contact_id.'">Bearbeiten</button></td>
							<td width="49%" style="padding-left:1%;"><form methode="post" form-type="confirm" form-message="Wollen Sie den Kontakt wirklich löschen?" form-url="/ajax/account/delete_contact/" form-redirect="/"><input value="'.$row->contact_id.'" name="id" type="hidden" /><button id="submit">Löschen</button></form></td>
						</tr>
					</table>
				</div>

			</div>
		</div>
	</div>
	';
}
?>