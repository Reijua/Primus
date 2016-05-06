<div class="banner" style="background-image:url(<?php echo $this->Partner_Model->get_banner($cdn_url, $object_job->company_id); ?>)">
</div>
<div class="content-wrapper light-grey">
	<div class="content-holder">
		<div class="column-1">
			<div class="column-content" style="margin-top: 25px;">
				<h2 style="margin-bottom: 10px;"><?=$object_job->job_title; ?></h2>
				<?=str_replace(array("\r", "\n","\r\n"), "<br />", $object_job->job_preamble); ?><br />
				<br />
				<?php if($this->Job_Model->get_section_item($object_job->job_id ,"Aufgaben")->num_rows() != 0){ ?>
				<strong>Aufgabenbereich:</strong>
				<ul>
					<?php
					foreach ($this->Job_Model->get_section_item($object_job->job_id ,"Aufgaben")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?php if($this->Job_Model->get_section_item($object_job->job_id ,"Qualifikationen")->num_rows() != 0){ ?>
				<strong>Qualifikationen:</strong>
				<ul>
					<?php
					foreach ($this->Job_Model->get_section_item($object_job->job_id ,"Qualifikationen")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?php if($this->Job_Model->get_section_item($object_job->job_id ,"Angebot")->num_rows() != 0){ ?>
				<strong>Angebot:</strong>
				<ul>
					<?php
					foreach ($this->Job_Model->get_section_item($object_job->job_id ,"Angebot")->result() as $row) {
						echo '<li>'.$row->item_text.'</li>';
					}
					?>
				</ul>
				<?php } ?>
				<?=str_replace(array("\r", "\n","\r\n"), "<br />", $object_job->job_ackknowledgement); ?><br />
				<br />
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<h4>Ansprechperson</h4>
				<hr color="#F5F5F5" />
				<?=$object_job->gender_id; ?><br />
				<?=($object_job->contact_title == "" ? "" : $object_job->contact_title." "); ?><?=$object_job->contact_firstname; ?> <?=$object_job->contact_lastname; ?><br />
				<br />
				<?php if($object_job->contact_email != ""){ ?><i class="icon-envelope"></i> <a href="mailto:<?=$object_job->contact_email; ?>"><?=$object_job->contact_email; ?></a><br /><?php }?>
				<?php if($object_job->contact_phone != ""){ ?><i class="icon-phone"></i> <?=$object_job->contact_phone; ?><br /><?php }?>
				<?php if($object_job->contact_fax != ""){ ?><i class="icon-printer"></i> <?=$object_job->contact_fax; ?><br /><?php }?>
			</div>
		</div>
		<div class="column-2">
			<div class="column-content">
				<h4>Bewerbungsort</h4>
				<hr color="#F5F5F5" />
				<strong><?=$object_job->location_name; ?></strong><br />
				<?=$object_job->location_address; ?><br />
				<?=$object_job->location_pc; ?> <?=$object_job->location_city; ?>
				
			</div>
		</div>
	</div>
</div>
<div class="content-wrapper dark-grey">
	<div class="arrow-holder"></div>
	<div class="content-holder">
		<div class="column-4"></div>
		<div class="column-4">
			<div class="column-content">
				<strong><?=$object_job->company_name ?></strong><br />
				asdf
			</div>			
		</div>
		<div class="column-2">
			<div class="column-content">
				<?=$object_job->company_description ?>
			</div>
		</div>
	</div>
</div>