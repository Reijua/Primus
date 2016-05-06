<?php 
	$this->load->helper("text");
?>
<style type="text/css">
.job-table{
	width: 100%;
	background-color: #FFFFFF;
	border-collapse: 0;
	border-spacing: 0;
}
	.job-table tr:first-child td{
		font-weight: bold;
		background-color: #3B5999;
		color: #FFFFFF;
		border-bottom: 2px solid #263962;
	}
	.job-table tr td{
		border-bottom: 1px solid #CCCCCC;
	}
	.job-table tr:last-child td{
		border-bottom: 0px;
	}
	.job-table tr td{
		padding: 10px;
	}
	.job-table tr td ul{
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.job-table tr td ul li{
		margin: 0;
		padding: 0;
		float: left;
		position: relative;
		padding: 0 10px;
		border-right: 1px solid #CCCCCC;
	}
	.job-table tr td ul li:first-child{
		padding-left: 0px;
	}
	.job-table tr td ul li:last-child{
		border-right: 0px;
		padding-right: 0px;
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
		<h3>Jobangebote</h3>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Job hinzufügen" modal-type="url" modal-data="/ajax/modal/add_job/">Hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<h4><?php echo $this->Job_Model->get_job("open",$this->session->userdata("account_id"))->num_rows() ?> <?php echo ($this->Job_Model->get_job("open",$this->session->userdata("account_id"))->num_rows()==1 ? 'aktuelles Jobangebot' : 'aktuelle Jobangebote'); ?></h3>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<table class="job-table">
			<tr>
				<td width="80px">Datum</td>
				<td width="*">Bezeichnung</td>
				<td width="50px" align="center">Views</td>
				<td width="160px">Optionen</td>
			</tr>
			<?php 
			foreach ($this->Job_Model->get_job("open",$this->session->userdata("account_id"))->result() as $row) {
			echo '<tr>
					<td width="80px">'.$row->release_date.'</td>
					<td>'.$row->job_title.'</td>
					<td align="center">'.$row->job_views.'</td>
					<td width="160px" align="center">
						<ul>
							<li><span class="modal link" modal-title="Jobangebot: '.$row->job_title.'" modal-type="url" modal-data="/ajax/modal/edit_job/'.$row->job_id.'">Bearbeiten</span></li>
							<li><form methode="post" form-url="/ajax/account/change_job_position/closed/" form-type="confirm" form-message="Sind Sie sicher, dass der Job schon vergeben ist?" form-redirect="/"><input type="hidden" name="id" value="'.$row->job_id.'" /><span class="link" id="submit">Schließen</span></form></li>
						</ul>
					</td>
				  </tr>';
			}
			?>
		</table>
	</div>
</div>
<?php 
if($this->Job_Model->get_job("closed",$this->session->userdata("account_id"))->num_rows() != 0){
?>

<div class="column-1">
	<div class="column-content">
		<h4>Bereits vergebene Jobangebote</h3>
	</div>
</div>
<div class="column-1">
	<div class="column-content">
		<table class="job-table">
			<tr>
				<td width="80px">Datum</td>
				<td width="*">Bezeichnung</td>
				<td width="50px" align="center">Views</td>
				<td width="160px">Optionen</td>
			</tr>
			<?php 
			foreach ($this->Job_Model->get_job("closed",$this->session->userdata("account_id"))->result() as $row) {
			echo '<tr>
					<td>'.$row->release_date.'</td>
					<td>'.$row->job_title.'</td>
					<td align="center">'.$row->job_views.'</td>
					<td align="center"> - </td>
				  </tr>';
			}
			?>
		</table>
	</div>
</div>
<?php
}
?>
