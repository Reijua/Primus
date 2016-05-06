<div class="banner" style="background-image: url(<?=$this->P_account_model->get_banner($resource_url, $company_id) ?>)">
	<table class="partner-logo">
		<tr>
			<td><img src="<?=$this->P_account_model->get_logo($resource_url, $company_id) ?>"></td>
		</tr>
	</table>
</div>
<div class="container light-grey">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-1">
			<div class="column-content" style="margin-top: 25px;">
				<h2 style="margin-bottom: 10px;"><?=$object_job->job_title; ?></h2>
				<?=str_replace(array("\r", "\n","\r\n"), "<br />", $object_job->job_preamble); ?><br />
				<br />
				<?php if($this->P_job_model->get_section_item($object_job->job_id ,"Aufgaben")->num_rows() != 0){ ?>
				<strong>Aufgabenbereich:</strong>
				<ul>
					<?php
					foreach ($this->P_job_model->get_section_item($object_job->job_id ,"Aufgaben")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?php if($this->P_job_model->get_section_item($object_job->job_id ,"Qualifikationen")->num_rows() != 0){ ?>
				<strong>Qualifikationen:</strong>
				<ul>
					<?php
					foreach ($this->P_job_model->get_section_item($object_job->job_id ,"Qualifikationen")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?php if($this->P_job_model->get_section_item($object_job->job_id ,"Angebot")->num_rows() != 0){ ?>
				<strong>Angebot:</strong>
				<ul>
					<?php
					foreach ($this->P_job_model->get_section_item($object_job->job_id ,"Angebot")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?=str_replace(array("\r", "\n","\r\n"), "<br />", $object_job->job_summary); ?><br />
				<br />
			</div>
		</div>
		<?php if($this->P_contact_model->get_contact(intval($company_id), "all", $object_job->contact_id)->num_rows() == 1){ ?>
		<?php $v_contact = $this->P_contact_model->get_contact(intval($company_id), "all", $object_job->contact_id)->row(); ?>
		<div class="column-2">
			<div class="column-content">
				<h4>Ansprechperson</h4>
				<hr color="#F5F5F5" />
				<?=$this->lang->line("gender_title_".$v_contact->gender_description); ?><br />
				<?=($v_contact->contact_title == "" ? "" : $v_contact->contact_title." "); ?><?=$v_contact->contact_firstname; ?> <?=$v_contact->contact_lastname; ?><br />
				<br />
				<?php if($v_contact->contact_email != ""){ ?><i class="icon-envelope"></i> <a href="mailto:<?=$v_contact->contact_email; ?>"><?=$v_contact->contact_email; ?></a><br /><?php }?>
				<?php if($v_contact->contact_phone != ""){ ?><i class="icon-phone"></i> <?=$v_contact->contact_phone; ?><br /><?php }?>
				<?php if($v_contact->contact_fax != ""){ ?><i class="icon-printer"></i> <?=$v_contact->contact_fax; ?><br /><?php }?>
			</div>
		</div>
		<?php } ?>
		<?php if($this->P_location_model->get_location(intval($company_id), "all", $object_job->location_id)->num_rows() == 1){ ?>
		<?php $v_location = $this->P_location_model->get_location(intval($company_id), "all", $object_job->location_id)->row(); ?>
		<div class="column-2">
			<div class="column-content">
				<h4>Bewerbungsort</h4>
				<hr color="#F5F5F5" />
				<strong><?=$v_location->location_name; ?></strong><br />
				<?=$v_location->location_address; ?><br />
				<?=$v_location->location_pc; ?> <?=$v_location->location_city; ?>
				
			</div>
		</div>
		<?php } ?>
		<nav class="breadcrumb">
			<ul>
				<li><a href="/"><i class="icon-home"></i></a></li>
				<li><i class="icon-angle-right"></i></li>
				<li><a href="/job/details/<?=$object_job->job_title ?>">Jobangebot: <?=$object_job->job_title; ?></a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow light-grey"></div>
	</div>
</div>