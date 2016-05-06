<div class="application-header">
	<div class="application-headline">Jobs</div>
	<div class="application-option"></div>
</div>
<div class="application-content">
	<?php
	$v_counter = 1;
	foreach ($this->Job_Model->get_job("all")->result() as $row) {
		echo '
		<div class="column-2">
			<div class="column-content">
				<div class="section-item" style="border:1px solid #CCCCCC;">
					<div class="section-content" style="height: 100px; overflow: hidden;">
						<h4><a style="color: #000000 !important;" target="_blank" href="/job/details/'.$row->job_id.'/">'.$row->job_title.'</a></h4>
						bei <a target="_blank" href="/company/details/'.$row->company_id.'/">'.$row->company_name.'</a><br />
						'.$row->job_preamble.'
					</div>
					<div class="section-footer">
						<hr color="#F5F5F5">
						<table>
							<tr>
								<td class="text-left" style="width: 33.333333334%;"><i class="icon-map-marker"></i> '.$row->location_name.'</td>
								<td class="text-center" style="width: 33.333333334%;"><i class="icon-user"></i> '.($row->contact_title == "" ? '' : $row->contact_title.' ').''.$row->contact_firstname.' '.$row->contact_lastname.'</td>
								<td class="text-right" style="width: 33.333333334%;"><i class="icon-time"></i> '.mdate("%d",mysql_to_unix($row->job_release_date)).'. '.$this->lang->line('cal_'.strtolower(mdate("%F",mysql_to_unix($row->job_release_date)))).' '.mdate("%Y",mysql_to_unix($row->job_release_date)).'</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		';
		if($v_counter%10 == 0){
			echo '<div class="column-1">
					<div class="column-content">
						<div class="section-item">
							<div class="section-header" style="height:250px;">
							</div>
						</div>
					</div>
				  </div>';
		}

		$v_counter++;
	}
	?>
	
</div>