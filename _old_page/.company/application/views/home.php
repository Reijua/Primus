<?php if(!$this->session->userdata('login')){ ?>
<div class="slider-wrapper">
</div>
<div id="content-wrapper">
	<div id="content-holder">
		<div class="column-3">
			<div class="column-content">
				<div class="fact">
					<div class="fact-circle">
						<img src="<?php echo $resource_url; ?>image/icon/network.png" alt="Network Icon" />
					</div>
					<h3>Netzwerk</h3>
					<p>Erhalten Sie Zugang zu einem exklusiven Netzwerk, welches ausschließlich aus HTL-Absolventen besteht. Falls Sie auf der Suche nach neuen Mitarbeitern sind, werden Sie in unserem Netzwerk bestimmt fündig. Wir wählen unsere Mitglieder nach strengen Kriterien aus und können Ihnen garantieren, dass Sie in unserem Netzwerk nur engagierte, ehrgeizige und vor allem qualifizierte Fachkräfte finden.</p>
				</div>
			</div>
		</div>
		<div class="column-3">
			<div class="column-content">
				<div class="fact">
					<div class="fact-circle">
						<img src="<?php echo $resource_url; ?>image/icon/ad.png" alt="Advertisement Icon" />
					</div>
					<h3>Firmenpräsenz</h3>
					<p>Präsentieren Sie sich als unser Partner bei diversen Events unseres Vereins. Hier können Sie beispielsweise Produkte und Dienstleistungen bewerben, oder auch unsere Mitglieder auf Ihr Unternehmen aufmerksam machen. Unser Ziel ist es, allen einen Mehrwert zu bieten - sowohl unseren Partnerunternehmen, als auch unseren Mitgliedern. Wenn alle betroffenen Parteien mit einem Mehrwert aussteigen, sehen wir unser Ziel als erreicht.</p>
				</div>
			</div>
		</div>
		<div class="column-3">
			<div class="column-content">
				<div class="fact">
					<div class="fact-circle">
						<img src="<?php echo $resource_url; ?>image/icon/target.png" alt="Target Icon" />
					</div>
					<h3>Zielgruppe</h3>
					<p>Weil Sie die Zielgruppe genau kennen, können Sie Ihre Marketing- und Rekrutierungsstrategie bestens ausrichten. Wir sehen unsere Lösung als sehr effiziente und preiswerte Alternative zu diversen anderen Medien.</p>					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="divider" id="white-dark-blue"></div>
<div id="content-wrapper" class="dark-blue">
	<div id="content-holder">
		<div class="column-1 text-center">
			<div class="column-content">
				<h1>Unsere Pakete</h1>
			</div>
		</div>
		<?php
		foreach ($array_package as $row) {
		echo '
			<div class="column-3">
				<div class="column-content">
					<div class="pricing-table">
						<div class="header">
							<h2>'.$this->lang->line("package_".strtolower($row->package_name)).'</h2>						
						</div>
						<div class="price">&euro; '.str_replace('.00', ',-', $row->package_price).'<br /><div class="interval">'.$this->lang->line("package_interval_year").'</div></div>
						<ul>
							<li>'.($row->package_profile==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_profile").'</li>
							<li>'.($row->package_partner==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_partner").'</li>
							<li>'.($row->package_product==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_product").'</li>
							<li>'.($row->package_job_offer==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_job_offer").'</li>
							<li>'.($row->package_advertisement==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_advertisement").'</li>
							<li>'.($row->package_support==1? '<i class="icon-true"></i>' : '<i class="icon-false"></i>').' '.$this->lang->line("package_permission_support").'</li>
						</ul>
						<table width="100%">
							<tr>
								<td width="50%"><a href="/registration/?package='.$row->package_id.'">Kaufen</a></td>
								<td width="50%"><a href="/package/details/'.strtolower($row->package_name).'">Mehr Informationen</a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>';
		}
		?>		
	</div>
</div>
<div class="divider" id="dark-blue-light-grey"></div>
<div id="content-wrapper" class="light-grey">
	<div id="content-holder">
		<div class="column-1">
			<div class="column-content text-center">
				<h1>Wir sind schon dabei!</h1>
			</div>
		</div>
		<?php 
		/*foreach ($array_company as $row) {
			echo '
			<div class="column-4">
				<div class="partner">
					<div class="logo">
						<img src="'.$row->company_logo.'" alt="'.$row->company_name.'">
					</div>
				</div>
			</div>
			';
		}*/
		?>
		<?php if(count($array_company)>4){ ?>
		<div class="column-1">
			<div class="column-content text-right">
				<a href="http://www.primus-romulus.net/partner/">Alle Partner Anzeigen</a>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php }else{ ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(this).initDock({
			p_dock_id: <?php echo ($this->input->cookie("dock")?$this->input->cookie("dock"):1); ?>
		});
	});
</script>
<div class="banner-wrapper" style="background-image: url();">
	<div class="company-logo">
		<img src="">
	</div>
	<div class="company-header">
		<section>
			<div class="column-1">
				<div class="column" style="width:70%;">
					<div class="column-content">
						<h2><?php echo $obj_account->company_name; ?></h2>
					</div>					
				</div>
				<div class="column" style="width:30%;">
				</div>
			</div>
		</section>
	</div>
</div>
<div id="dock-wrapper">
	
</div>
<div id="content-wrapper" class="light-grey">
	<div id="content-holder">
		
	</div>
</div>
<?php } ?>
<div class="divider" id="light-grey-dark-grey"></div>