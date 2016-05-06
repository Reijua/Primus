<?php

	$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(this).initFormSystem();
		$(this).modal();
	});
</script>
<div class="application-header">
	<div class="application-headline"><h3>Über <?=$object_account->company_name; ?></h3></div>
	<div class="application-options">
		<ul>
			<li><button class="modal" data-title="Einstellungen" data-type="url" data-source="/ajax/modal/settings/">Bearbeiten</button></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<div class="application-column-left">
		<div class="application-column-content">
			<div class="section-item" style="margin-bottom:20px;">
				<div class="section-content">
					<h4>Beschreibung</h4>
					<?=str_replace(array("\n", "\r", "\r\n"), "<br />", $object_account->company_description); ?><br />
					<br />
					<br />
					<h4>Sonstiges</h4><br />
					<div class="responsive-table">
						<table class="table">
							<tbody>
								<tr>
									<td style="width:150px; min-width:150px;"><strong>Branche</strong></td>
									<td style="min-width:300px;">
										<?php foreach ($this->Account_Model->get_branche($object_account->company_id)->result() as $row) { ?>
										<?=$row->branche_name ?><br />
										<?php }?>
									</td>
								</tr>
								<?php foreach ($this->Account_Model->get_property($this->session->userdata("account_id"))->result() as $row) { ?>
								<tr>
									<td style="width:150px; min-width:150px;"><strong><?=$row->property_name?></strong></td>
									<td style="min-width:300px;"><?=$row->property_text?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="section-footer"></div>
			</div>
		</div>
	</div>
	<div class="application-column-right">
		<div class="application-column-content">
			<div class="section-item" style="margin-bottom:15px;">
				<div class="section-header" style="background-color: #FFFFFF;">
					<table>
						<tr>
							<td><img src="<?=$this->Account_Model->get_logo($cdn_url, $object_account->company_id); ?>" /></td>
						</tr>
					</table>
				</div>
				<div class="section-content">
					<strong><?=$object_account->company_name ?></strong><br />
					<?php if($this->Account_Model->get_location(intval($this->session->userdata("account_id")), "all", $object_account->location_id)->num_rows() == 1){ ?>
					<?php $v_location = $this->Account_Model->get_location(intval($this->session->userdata("account_id")), "all", $object_account->location_id)->row(); ?>
					<?=$v_location->location_address; ?><br />
					<?=$v_location->location_pc; ?> <?=$v_location->location_city; ?>
					<?php }	?>
					<hr />
					<ul class="social-network">
						<?php
						/*foreach ($this->Account_Model->get_link($this->session->userdata("account_id"), "SOCAIL_NETWORK")->result() as $row) {
							echo '<li>asdf</li>';
						}*/
						?>
					</ul>
				</div>
			</div>
			<?php if($this->Account_Model->get_contact(intval($this->session->userdata("account_id")), "all", $object_account->contact_id)->num_rows() == 1){ ?>
			<?php $v_contact = $this->Account_Model->get_contact(intval($this->session->userdata("account_id")), "all", $object_account->contact_id)->row(); ?>
			<div class="section-item">
				<div class="section-content">
					<h4>Kontaktperson</h4>
					<div class="text-center" style="padding-top:20px;">
						<img src="<?=$this->Account_Model->get_contact_portrait($resource_url, $object_account->company_id, $v_contact->contact_id, $v_contact->gender_id) ?>" class="circle-image large border">	
					</div>
					<hr />
					<?= $this->lang->line('gender_title_'. $v_contact->gender_description) ?><br />
					<?=($v_contact->contact_title != "" ? $v_contact->contact_title." " : "") ?> <?=$v_contact->contact_firstname ?> <?=$v_contact->contact_lastname ?><br />
					<br />
					<?php if(!empty($v_contact->contact_email)){ ?><i class="icon-envelope" style="width:20px; margin-right:5px;"></i> <a href="mailto:<?=$v_contact->contact_email; ?>"><?=$v_contact->contact_email; ?></a><br /><?php } ?>
					<?php if(!empty($v_contact->contact_phone)){ ?><i class="icon-phone" style="width:20px; margin-right:5px;"></i> <?=$v_contact->contact_phone; ?><br /><?php } ?>
					<?php if(!empty($v_contact->contact_fax)){ ?><i class="icon-print" style="width:20px; margin-right:5px;"></i> <?=$v_contact->contact_fax; ?><br /><?php } ?>
					<?=($v_contact->contact_tip != "" ? "<hr />Bewerbungstipp: ".$v_contact->contact_tip : "")?>
				</div>
			</div>
			<?php }	?>
		</div>
	</div>
</div>
<div class="placeholder"></div>