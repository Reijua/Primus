<style type="text/css">
	.partner-item{
		position: relative;
		float: left;
		margin: 10px 0;
		width: 100%;
		background-color: #FFFFFF;
	}
		.partner-item .partner-header{
			padding: 10px;
			height: 210px;
		}			
			.partner-item .partner-header table{
				width: 100%;
				height: 210px;
				border-spacing: 0;
				border-collapse: 0;
				vertical-align: middle;
			}
				.partner-item .partner-header table tr td{
					width: 100%;
					height: 210px;
					vertical-align: middle;
					text-align: center;
				}
					.partner-item .partner-header table tr td img{
						max-width: 100%;
						max-height: 100%;
						width: auto;
						height: auto;
						
					}
		.partner-item a.hover{
			display: none;
		}
		.partner-item:hover a.hover{
			position: absolute;
			top: 0;
			left: 0;
			background-color: #3B5999;
			width: 100%;
			height: 100%;
			display: block;
			cursor: pointer;
			color: #FFFFFF !important;
		}
			.partner-item:hover a.hover table{
				width: 100%;
				height: 100%;
				border-spacing: 0;
				border-collapse: 0;
			}
				.partner-item:hover a.hover table tr td{
					width: 100%;
					height: 100%;
					text-align: center;
					vertical-align: middle;
					font-size: 20px;
				}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".item-slider").initItemSlider({});
});
</script>
<div class="banner" style="background-image: url(<?php echo $resource_url; ?>image/banner/city.jpg);">

</div>
<div class="container dark-blue">
	<div class="container-content">
		<div class="placeholder"></div>
		<div class="column-3">
			<div class="column-content text-center">
				<div class="square-icon large">
					<img src="<?php echo $resource_url; ?>image/icon/fact/network.png" alt="Icon Name">
				</div>
				<h3>Netzwerk</h3>
				Werde Teil eines einzigartigen Netzwerks. Es spielt keine Rolle in welcher Branche du beruflich tätig bist. Genieße einfach die Vorteile vom Primus Romulus Netzwerk!
			</div>
		</div>
		<div class="column-3">
			<div class="column-content text-center">
				<div class="square-icon large">
					<img src="<?php echo $resource_url; ?>image/icon/fact/job.png" alt="Job">
				</div>
				<h3>Jobangebote</h3>
				Du bist gerade frisch mit der HTBLA Kaindorf fertig geworden und suchst einen Arbeitsplatz? Wir haben das eine oder andere Jobangebot, was für dich interessant sein könnte.
			</div>
		</div>
		<div class="column-3">
			<div class="column-content text-center">
				<div class="square-icon large">
					<img src="<?php echo $resource_url; ?>image/icon/fact/event.png" alt="Icon Name">
				</div>
				<h3>Veranstaltungen</h3>
				Durch interessante Vorträge, kulinarische Köstlichkeiten aus der Region und unterhaltsame Freizeitaktivitäten wollen wir die Interessen unserer Mitglieder widerspiegeln und sie dadurch auch weiterbilden.
			</div>
		</div>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container light-grey">
	<div class="container-content">
		<div class="arrow dark-blue"></div>
		<div class="column-1">
			<div class="column-content text-center">
				<h1>Partner</h1>
				<?php if(count($array_partner) > 10){ ?>
				<div class="container-description">
					Vom steirischen Kleinunternehmen bis zum international agierenden TOP-Unternehmen ist bei <a href="/partner/">uns</a> alles vertreten.
				</div>
				<?php } ?>
			</div>
		</div>
		<?php foreach ($array_partner as $row) { ?>
		<div class="column-4">
			<div class="column-content">
				<div class="partner-item">
					<div class="partner-header">
						<table>
							<tr>
								<td><img src="<?php
									if(file_exists(FCPATH.'/resource/image/partner/logo/'.$row->company_id.'.png'))
									{
										echo $resource_url.'image/partner/logo/'.$row->company_id.'.png';
									}
									else if(file_exists(FCPATH.'/resource/image/partner/logo/'.$row->company_id.'.jpg'))
									{
										echo $resource_url.'image/partner/logo/'.$row->company_id.'.jpg';
									}else
									{
										echo $resource_url.'image/partner/logo/default.png';
									}
								?>" alt="<?=html_escape($row->company_name) ?>"/></td>
								<!-- <td><img src="<?=( file_exists(FCPATH.'/resource/image/partner/logo/'.$row->company_id.'.png') ? $resource_url.'image/partner/logo/'.$row->company_id.'.png' : file_exists(FCPATH.'/resource/image/partner/logo/'.$row->company_id.'.jpg') ? $resource_url.'image/partner/logo/'.$row->company_id.'.jpg' : $resource_url.'image/partner/logo/default.png' ) ?>" alt="<?=html_escape($row->company_name) ?>" /></td> -->
							</tr>
						</table>								
					</div>
					<?php if($this->Company_Model->get_website($row->company_id, "WEBSITE")->num_rows() > 0){ ?>
					<a href="<?=($this->Company_Model->get_website($row->company_id, "WEBSITE")->num_rows() > 1 ? $this->Company_Model->get_website($row->company_id, "WEBSITE")->row(rand(0 ,$this->Company_Model->get_website($row->company_id, "WEBSITE")->num_rows()))->website_url : $this->Company_Model->get_website($row->company_id, "WEBSITE")->row()->website_url) ?>" class="hover">
						<table>
							<tr>
								<td><?=html_escape($row->company_name)?></td>
							</tr>
						</table>
					</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="placeholder"></div>
	</div>
</div>
<div class="container white">
	<div class="container-content">
		<div class="arrow light-grey"></div>
		<div class="column-1">
			<div class="column-content text-center">
				<h1>Neuigkeiten</h1>
				<div class="container-description">
					Alles wissenswerte auf einen Blick!
				</div>
				
			</div>
		</div>
		<div class="column-1">
			<div class="item-slider">
				<div class="left-btn"><i class="icon-angle-left"></i></div>
				<div class="item-content">
					<div class="item-list">
						<?php
						foreach ($array_news as $row) {
							echo '	<div class="item">
										<div class="item-content">
											<div class="section-item">
												<div class="section-header" style="background-image: url('.( (file_exists(FCPATH.'/resource/image/news/'.$row->news_id.'.png') == true) ? $resource_url.'image/news/'.$row->news_id.'.png' : ( (file_exists(FCPATH.'/resource/image/news/'.$row->news_id.'.jpg') == true) ? $resource_url.'image/news/'.$row->news_id.'.jpg' : '' ) ).');"></div>
												<div class="section-content">
													<h4>'.$row->news_title.'</h4>
													'.word_limiter(str_replace(array("[removed]"), array(""), $row->news_text),20).'
													<hr style="color:#CCCCCC;">
													<i class="icon-calender"></i> '.mdate('%j.',mysql_to_unix($row->news_release_date)).' '.$this->lang->line('cal_'.strtolower(mdate('%F',mysql_to_unix($row->news_release_date)))).' '.mdate('%Y',mysql_to_unix($row->news_release_date)).'
												</div>
												<a href="/news/details/'.$row->news_id.'/" class="section-hover">
													<table>
														<tr>
															<td>Weiterlesen</td>
														</tr>
													</table>
												</a>
											</div>
										</div>
									</div>';
						}
						?>
					</div>
				</div>
				<div class="right-btn"><i class="icon-angle-right"></i></div>
			</div>
		</div>
		<div class="placeholder"></div>
	</div>
</div>

<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow white"></div>
	</div>
</div>


