<script type="text/javascript" src="<?php echo $resource_url; ?>js/highcharts.js"></script>
<script type="text/javascript">
$("#user-chart-bar").highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mitgliederstatistik'
        },
        xAxis: {
            categories: [<?php foreach ($this->Account_Model->get_statistic()->result() as $row) {
		echo '"'.$this->lang->line("cal_".strtolower($row->view_month)).'", ';
	} ?>]
        },
        yAxis: {
            title: {
                text: 'Mitgliederanzahl'
            }
        },
        series: [{
            name: 'Anmeldungen',
            data: [<?php foreach ($this->Account_Model->get_statistic()->result() as $row) {
		echo $row->view_member_amount.', ';
	} ?>],
			color: "#3B5999"
        }],
        credits: {
      		enabled: false
  		},
    });
</script>
<div class="application-header">
	<div class="application-headline">Dashboard</div>
	<div class="application-option"></div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:20px 0;">
				<div id="user-chart-bar" ></div>				
			</div>
		</div>
	</div>
	<div class="column-3">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:50px 0;">
				<div class="section-content">
					<div class="text-center" style="font-size: 60px;"><?php echo $this->Account_Model->get_account("all")->num_rows(); ?></div>
					<div class="text-center" style="font-size: 25px;">Mitglieder</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="column-3">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:50px 0;">
				<div class="section-content">
					<div class="text-center" style="font-size: 60px;"><?php echo $this->Event_Model->get_event()->num_rows(); ?></div>
					<div class="text-center" style="font-size: 25px;">Events</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="column-3">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:50px 0;">
				<div class="section-content">
					<div class="text-center" style="font-size: 60px;">1</div>
					<div class="text-center" style="font-size: 25px;">Firmen</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="column-4">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:50px 0;">
				<div class="section-content">
					<div class="text-center" style="font-size: 60px;">12</div>
					<div class="text-center" style="font-size: 25px;">Sektflaschen</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="column-4">
		<div class="column-content">
			<div class="section-item" style="border:1px solid #CCCCCC; padding:50px 0;">
				<div class="section-content">
					<div class="text-center" style="font-size: 60px;">223</div>
					<div class="text-center" style="font-size: 25px;">Brötchen</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="column-1" style="height:10px;">
	</div>
</div>