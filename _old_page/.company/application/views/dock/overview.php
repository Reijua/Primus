<style type="text/css">

.job-preview{
	margin: 10px 0;
}
	.job-preview h6{
		color: #3b5999;
	}

.fact-table{
	width: 100%;
	margin: 0 auto;
	border-spacing: 0;
	border-collapse: 0;
}
	.fact-table tr td{
		border-bottom: 1px solid #F1F1F1;
		padding: 10px;
	}
	.fact-table tr td:first-child{
		font-weight: bold;
	}

.portrait{
	text-align: center;
	padding: 10px 0;
}
	.portrait img{
		border:1px solid #CCCCCC;
		border-radius: 200px;
		margin: 0 auto;
		width: 200px;
	}

.left-column{
	position: relative;
	float: left;
	width: 800px;
}
.right-column{
	position: relative;
	float: left;
	width: 400px;
}

	.left-column section, .right-column section{
		position: relative;
		float: left;
		width: 100%;
		height: auto;
	}

			.left-column section .section-content{
				margin-top: 10px;
				margin-left:20px;
				margin-right:5px;
				padding: 15px;
				background-color: #FFFFFF;
			}
			.right-column section .section-content{
				margin-top: 10px;
				margin-left:5px;
				margin-right:20px;
				padding: 15px;
				background-color: #FFFFFF;
			}

.socail-network-list{
	list-style: none;
	margin: 0;
	padding: 0;
	height: 30px;

}
	.socail-network-list li{
		padding: 0 5px;
		float: left;
	}
	.socail-network-list li:first-child{
		padding-left: 0px;
	}
		.socail-network-list li img{
			width: 30px;
			height: 30px;
		}

@media screen and (max-width: 1200px){
	.left-column{
		position: relative;
		float: left;
		width: 66.66666666666%;
	}
	.right-column{
		position: relative;
		float: left;
		width: 33.33333333333%;
	}
}

@media screen and (max-width: 1000px){
	.left-column{
		position: relative;
		float: left;
		width: 100%;
	}
	.right-column{
		position: relative;
		float: left;
		width: 100%;
	}

	.left-column section{
		position: relative;
		float: left;
		width: 100%;
	}

	.right-column section{
		position: relative;
		float: left;
		width: 50%;
	}

	.left-column section .section-content{
		margin-top: 10px;
		margin-left:20px;
		margin-right:20px;
		padding: 15px;
		background-color: #FFFFFF;
	}
	.right-column section .section-content{
		margin-top: 10px;
		margin-left:20px;
		margin-right:20px;
		padding: 15px;
		background-color: #FFFFFF;
	}
	.right-column section:nth-child(2n+1) .section-content{
		margin-right: 5px;
	}
	.right-column section:nth-child(2n) .section-content{
		margin-left: 5px;
	}

}

@media screen and (max-width: 700px){
	.left-column section .section-content, .right-column section .section-content{
		margin: 10px;
		padding: 10px;
		background-color: #FFFFFF;
	}
}

@media screen and (max-width: 650px){
	.left-column{
		position: relative;
		float: left;
		width: 100%;
	}
	.right-column{
		position: relative;
		float: left;
		width: 100%;
	}

	.left-column section{
		position: relative;
		float: left;
		width: 100%;
	}

	.right-column section{
		position: relative;
		float: left;
		width: 100%;
	}

}

</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).modal();
		$(this).initFormSystem();
	});
</script>
<div class="column-1">
	<div class="column-content">
		<h2>Übersicht</h2>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Einstellungen" modal-type="url" modal-data="/ajax/modal/settings/">Bearbeiten</li>
			</ul>
		</div>
	</div>
</div>
<div class="left-column">
	<section>
		<div class="section-content">
			<h4>Beschreibung</h4><br />
			<?php echo str_replace("\n", "<br />", $object_account->company_description); ?>
			<br />
			<br />
			<h4>Sonstige Informationen</h4><br />
			<table class="fact-table">
				<?php if($object_account->branche_id != 0){ ?>
				<tr>
					<td width="190px">Branche:</td>
					<td><?php echo $this->Account_Model->get_branche($object_account->branche_id)->row()->branche_name; ?></td>
				</tr>
				<?php } ?>
				<?php if($object_account->company_release_year != 0){ ?>
				<tr>
					<td width="190px">Gründungsjahr:</td>
					<td><?php echo $object_account->company_release_year; ?></td>
				</tr>
				<?php } ?>
				<?php if($object_account->amount_of_employee != ""){ ?>
				<tr>
					<td width="190px">Mitarbeiter:</td>
					<td><?php echo $object_account->amount_of_employee; ?></td>
				</tr>
				<?php } ?>
				<?php if($object_account->employee_per_year != ""){ ?>
				<tr>
					<td width="190px">Gesuchte Mitarbeiter/Jahr:</td>
					<td><?php echo $object_account->employee_per_year; ?></td>
				</tr>
				<?php } ?>
				<?php if($object_account->most_common_employee != ""){ ?>
				<tr>
					<td width="190px">Häufig gesuchte Mitarbeiter:</td>
					<td><?php echo $object_account->most_common_employee; ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>		
	</section>
	<?php if($this->Job_Model->get_job("open",$this->session->userdata('account_id'))->num_rows()!=0 OR $this->Job_Model->get_job("closed",$this->session->userdata('account_id'))->num_rows()!=0){ ?>
	<section>
		<div class="section-content">
		<h4><?php echo ($this->Job_Model->get_job("open",$this->session->userdata('account_id'))->num_rows()==1? '1 aktueller Job' : $this->Job_Model->get_job("open",$this->session->userdata('account_id'))->num_rows().' aktuelle Jobs'); ?></h4>
		<?php
		$count=0;
		foreach ($this->Job_Model->get_job("open",$this->session->userdata('account_id'))->result() as $row) {
			echo '<div class="job-preview">
					<h6>'.$row->job_title.'</h6>
					'.word_limiter($row->job_preface,50).'
				  </div>';
			$count++;
			if($count==10){
				break;
			}
		}
		?>
		<?php if($count<10){ ?>
		<br />
		<h4>Bereits vergebene Jobs</h4>
		<?php
		foreach ($this->Job_Model->get_job("closed",$this->session->userdata('account_id'))->result() as $row) {
			echo $row->job_title.'<br />';
			$count++;
			if($count==10){
				break;
			}
		}
		?>
		<?php } ?>
			<div class="text-right">
			</div>		
		</div>
		
	</section>
	<?php } ?>
</div>
<div class="right-column">
	<section>
		<div class="section-content">
			<div style="text-align:center;">
				<img src="">
			</div>
			<br />
			<h4><?php echo $object_account->company_name; ?></h4>
			
			<?php if($this->Account_Model->get_location($object_account->company_id, $object_account->location_id)->num_rows()!=0){ ?>
			<?php $object_location = $this->Account_Model->get_location($object_account->company_id, $object_account->location_id)->row(); ?>
			<address>
				<?php echo $object_location->location_address.'<br />'; ?>
				<?php echo $object_location->location_pc.' '.$object_location->location_city.'<br />'; ?>
			</address>
			<br />
			<?php echo ($object_location->location_email!="" ? '<i class="icon-envelope"></i> <a href="mailto:'.$object_location->location_email.'">'.$object_location->location_email.'</a><br />' : '' ); ?>
			<?php echo ($object_location->location_phone!="" ? '<i class="icon-phone"></i> '.$object_location->location_phone.'<br />' : '' ); ?>
			<?php echo ($object_location->location_fax!="" ? '<i class="icon-fax"></i> '.$object_location->location_fax.'<br />' : '' ); ?>
			<?php echo ($object_location->location_website!="" ? '<i class="icon-globe"></i> <a href="http://'.$object_location->location_website.'">'.$object_location->location_website.'</a><br />' : '' ); ?>
			<?php } ?>
			<hr color="#CCCCCC">
			<ul class="socail-network-list">
				<?php echo ($object_account->company_facebook==""?'':'<li><a href="'.$object_account->company_facebook.'"><img src="'.$resource_url.'image/icon/facebook.png"></a></li>'); ?>
				<?php echo ($object_account->company_google_plus==""?'':'<li><a href="'.$object_account->company_google_plus.'"><img src="'.$resource_url.'image/icon/googleplus.png"></a></li>'); ?>
				<?php echo ($object_account->company_linkedin==""?'':'<li><a href="'.$object_account->company_linkedin.'"><img src="'.$resource_url.'image/icon/linkedin.png"></a></li>'); ?>
				<?php echo ($object_account->company_twitter==""?'':'<li><a href="'.$object_account->company_twitter.'"><img src="'.$resource_url.'image/icon/twitter.png"></a></li>'); ?>
				<?php echo ($object_account->company_xing==""?'':'<li><a href="'.$object_account->company_xing.'"><img src="'.$resource_url.'image/icon/xing.png"></a></li>'); ?>
				<?php echo ($object_account->company_youtube==""?'':'<li><a href="'.$object_account->company_youtube.'"><img src="'.$resource_url.'image/icon/youtube.png"></a></li>'); ?>
			</ul>
		</div>
	</section>
	<?php if($this->Account_Model->get_contact($this->session->userdata('account_id'),$object_account->contact_id)->num_rows()!=0){ ?>
	<section>
		<div class="section-content">
			<?php $object_contact = $this->Account_Model->get_contact($this->session->userdata('account_id'),$object_account->contact_id)->row(); ?>
			<h4>Kontaktperson</h4>
			
			<div class="portrait">
				<img src="<?php echo ($object_contact->contact_portrait == "" ? ( $object_contact->gender_name=="female" ? $resource_url.'image/portrait/female.png' : $resource_url.'image/portrait/male.png') : $object_contact->contact_portrait ); ?>">
			</div>
			<hr color="#CCCCCC" />
			<?php echo $this->lang->line('gender_salutation_'.$object_contact->gender_name); ?><br />
			<?php echo $object_contact->contact_firstname; ?> <?php echo $object_contact->contact_lastname; ?><br />
			<small>- <?php echo $object_contact->contact_position; ?></small><br />
			<br />
			<?php echo ( $object_contact->contact_email == "" ?'':'<i class="icon-envelope"></i> <a href="mailto:'.$object_contact->contact_email.'">'.$object_contact->contact_email.'</a><br />'); ?>
			<?php echo ( $object_contact->contact_phone == "" ?'':'<i class="icon-phone"></i> '.$object_contact->contact_phone.'<br />'); ?>
		</div>
	</section>
	<?php } ?>
	<section style="width:100%;"></section>
</div>