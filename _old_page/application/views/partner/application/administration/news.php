<script type="text/javascript">
$(document).ready(function () {
	$(this).modal();
	$(this).initFormSystem();
	$(".application-content").css({"height": $(".column-right").height()-$(".application-header").outerHeight(true)+"px"});
	$("#filter_news_category").change(function(){
		if($(this).val() != 0){
			v_val = $(this).val();
			$(".application-content").children().each(function(){
				if($(this).attr("data-category") == v_val){
					if($(this).is(":hidden")){
						$(this).delay(500).fadeIn(500);
					}
				}else{
					if($(this).is(":visible")){
						$(this).fadeOut(500);
					}					
				}
			});
		}else{
			$(".application-content").children(":hidden").fadeIn(500);
		}
	});
});
</script>
<div class="application-header">
	<div class="application-headline">News</div>
	<div class="application-option">
		<ul>
			<li><span class="link modal" data-title="News hinzufügen" data-type="url" data-source="/ajax/modal/create_news/">Neuigkeiten erstellen</span></li>
			<li><span class="link modal" data-title="Kategorieverwaltung" data-type="url" data-source="/ajax/modal/manage_news_category/">Kategorieverwaltung</span></li>
			<li>Kategorie:
				<select id="filter_news_category" name="category">
					<option value="0">Alle</option>
					<?php
					foreach ($this->News_Model->get_category()->result() as $row) {
					echo '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
					}
					
					?>
				</select>
			</li>
		</ul>
	</div>
</div>
<div class="application-content">
	<?php
	foreach ($this->News_Model->get_news("all")->result() as $row) {
		echo '	<div class="column-4" data-category="'.$row->category_id.'">
					<div class="column-content">
						<div class="section-item">
							<div class="section-header" style="background-image: url('.$this->News_Model->get_banner($cdn_url, $row->news_id).')"></div>
							<div class="section-content" style="height: 100px; overflow: hidden;">
								<strong>'.$row->news_title.'</strong><br />
								<br />
								'.$row->news_text.'
							</div>
							<div class="section-footer">
								<table>
									<tr>
										<td style="width:49%; padding-right:1%;">
											<button class="modal" data-title="News bearbeiten" data-type="url" data-source="/ajax/modal/edit_news/'.$row->news_id.'/">Bearbeiten</button>
										</td>
										<td style="width:49%; padding-left:1%;">
											<form methode="post" data-url="/ajax/news/delete_news/'.$row->news_id.'/" data-type="confirm" data-text="Wollen Sie diese News wirklich löschen?" data-redirect="/">
												<button class="submit">Löschen</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>';
	}
	?>
	<div class="column-1" style="height:10px;"></div>
</div>