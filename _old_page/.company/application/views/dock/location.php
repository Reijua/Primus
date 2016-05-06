<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(this).initFormSystem();
	});
</script>
<div class="column-1">
	<div class="column-content">
		<h3>Standort</h3>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Standort hinzufügen" modal-type="url" modal-data="/ajax/modal/add_location/">Hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<?php
foreach ($this->Account_Model->get_location($this->session->userdata('account_id'))->result() as $row) {
	echo '<div class="column-2">
			<div class="column-content">
				<div class="location-thumbnail">
					<div class="header">
						<h3>'.$row->location_name.'</h3>
					</div>
					<iframe src="https://www.google.com/maps/?q='.str_replace(" ", "+", $row->location_address).',+'.$row->location_pc.'+'.str_replace(" ", "+", $row->location_city).',+'.$row->country_name.'&z=11&t=m&oe=utf8&f=q&output=embed&s=" width="100%" height="200" frameborder="0"></iframe>
					<div class="detail">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="50%">
									<strong>Adresse:</strong><br />
									'.$row->location_address.'<br />
									'.$row->location_pc.' '.$row->location_city.'<br />
									'.$row->country_name.'
								</td>
								<td width="50%" align="right">
									'.( $row->location_email == "" ?'':'<a href="mailto:'.$row->location_email.'">'.$row->location_email.'</a> <i class="icon-envelope"></i><br />' ).'
									'.( $row->location_phone == "" ?'':''.$row->location_phone.' <i class="icon-phone"></i><br />' ).'
									'.( $row->location_fax == "" ?'':''.$row->location_fax.' <i class="icon-fax"></i><br />' ).'
									'.( $row->location_website == "" ?'':'<a href="http://'.$row->location_website.'/" target="_blank">'.$row->location_website.'</a> <i class="icon-globe"></i><br />' ).'
								</td>
							</tr>
						</table>
					</div>
					<div class="option-bar">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="49%" style="padding-right:1%;"><button class="modal" modal-title="Standort: '.$row->location_name.'" modal-type="url" modal-data="/ajax/modal/edit_location/'.$row->location_id.'">Bearbeiten</button></td>
								<td width="49%" style="padding-left:1%;"><form methode="post" form-type="confirm" form-message="Wollen Sie den Standort wirklich löschen?" form-url="/ajax/account/delete_location/" form-redirect="/"><input value="'.$row->location_id.'" name="id" type="hidden" /><button id="submit">Löschen</button></form></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		  </div>';
}
?>
