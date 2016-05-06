<script type="text/javascript">
$(document).ready(function () {
	$(this).modal();
	$(this).initFormSystem();
});
</script>
<div class="application-header">
	<div class="application-headline">Events</div>
	<div class="application-option">
		<ul>
			<li><span class="link modal" data-title="Event erstellen" data-type="url" data-source="/ajax/modal/create_event/">Hinzufügen</span></li>
		</ul>
	</div>
</div>
<div class="application-content">
	<?php
	$v_event_counter = 0;
	foreach ($this->Event_Model->get_event()->result() as $row) {
		if($v_event_counter%2==0){
			echo '<div class="column-1"></div>';
		}
		echo '<div class="column-2">
				<div class="column-content">
					<div class="section-item">
						<div class="section-header" style="height:200px;">
							<iframe src="https://www.google.com/maps/?q='.str_replace(" ", "+", $row->event_address).',+'.$row->event_pc.'+'.str_replace(" ", "+", $row->event_city).',+Österreich&z=11&t=m&oe=utf8&f=q&output=embed&s=" width="100%" height="100%" frameborder="0"></iframe>
						</div>
						<div class="section-content">
							<h3 class="text-center">'.$row->event_name.'</h3>
							<hr color="#CCCCCC" />
							<table style="width: 100%;">
								<tr>
									<td style="width:33.33333333%;" class="text-center">
										<div style="font-size: 50px; font-weight:bold;">'.( strtolower($row->type_name) == strtolower('public') && $row->event_amount_member==-1 ? '<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjAiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8cGF0aCBkPSJNMjIuOCwyNy41TDIyLjgsMjcuNUwyMi44LDI3LjVMMjIuOCwyNy41eiBNMzcsMTJMMzcsMTJjLTUuNywwLTguNywzLjYtMTAuOSw4YzAuNCwwLjgsMC43LDEuNiwxLjEsMi40CgljMi4xLTQuNiw0LjYtOC40LDkuOC04LjRjNi4xLDAsMTEsNC45LDExLDExYzAsMCwwLDAsMCwwYzAsNi4wNjUtNC45MzUsMTEtMTEsMTFjLTYuMzMzLDAtOC42MzgtNS41My0xMS4wNzctMTEuMzg1CglDMjMuMzM5LDE4LjQxMywyMC42NjcsMTIsMTMsMTJDNS44MzIsMTIsMCwxNy44MzIsMCwyNWMwLDcuMiw1LjgsMTMsMTMsMTNjNS43LDAsOC43LTMuNiwxMC45LTguMWMtMC40LTAuOC0wLjctMS42LTEuMS0yLjQKCUMyMC43LDMyLjIsMTguMiwzNiwxMywzNkM2LjksMzYsMiwzMS4xLDIsMjVjMC02LjA2NSw0LjkzNS0xMSwxMS0xMWM2LjMzMywwLDguNjM4LDUuNTMsMTEuMDc3LDExLjM4NQoJQzI2LjY2MSwzMS41ODcsMjkuMzMzLDM4LDM3LDM4YzcuMTY4LDAsMTMtNS44MzIsMTMtMTNoMEM1MCwxNy44LDQ0LjIsMTIsMzcsMTJ6Ij48L3BhdGg+Cjwvc3ZnPg==" style="height: 50px;" />' : $this->Event_Model->get_member($row->event_id)->num_rows()).'</div>
										Teilnehmer
									</td>
									<td style="width:33.33333333%;" class="text-center">
										<div style="font-size: 50px; font-weight:bold;">'.( strtolower($row->type_name) == strtolower('public') && $row->event_amount_member==-1 ? '<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjAiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8cGF0aCBkPSJNMjIuOCwyNy41TDIyLjgsMjcuNUwyMi44LDI3LjVMMjIuOCwyNy41eiBNMzcsMTJMMzcsMTJjLTUuNywwLTguNywzLjYtMTAuOSw4YzAuNCwwLjgsMC43LDEuNiwxLjEsMi40CgljMi4xLTQuNiw0LjYtOC40LDkuOC04LjRjNi4xLDAsMTEsNC45LDExLDExYzAsMCwwLDAsMCwwYzAsNi4wNjUtNC45MzUsMTEtMTEsMTFjLTYuMzMzLDAtOC42MzgtNS41My0xMS4wNzctMTEuMzg1CglDMjMuMzM5LDE4LjQxMywyMC42NjcsMTIsMTMsMTJDNS44MzIsMTIsMCwxNy44MzIsMCwyNWMwLDcuMiw1LjgsMTMsMTMsMTNjNS43LDAsOC43LTMuNiwxMC45LTguMWMtMC40LTAuOC0wLjctMS42LTEuMS0yLjQKCUMyMC43LDMyLjIsMTguMiwzNiwxMywzNkM2LjksMzYsMiwzMS4xLDIsMjVjMC02LjA2NSw0LjkzNS0xMSwxMS0xMWM2LjMzMywwLDguNjM4LDUuNTMsMTEuMDc3LDExLjM4NQoJQzI2LjY2MSwzMS41ODcsMjkuMzMzLDM4LDM3LDM4YzcuMTY4LDAsMTMtNS44MzIsMTMtMTNoMEM1MCwxNy44LDQ0LjIsMTIsMzcsMTJ6Ij48L3BhdGg+Cjwvc3ZnPg==" style="height: 50px;" />' : ($row->event_amount_member - $this->Event_Model->get_member($row->event_id)->num_rows())).'</div>
										Freie Plätze
									</td>
									<td style="width:33.33333333%;" class="text-center">
										<div style="font-size: 50px; font-weight:bold;">'.( strtolower($row->type_name) == strtolower('public') && $row->event_amount_member==-1 ? '<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjAiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8cGF0aCBkPSJNMjIuOCwyNy41TDIyLjgsMjcuNUwyMi44LDI3LjVMMjIuOCwyNy41eiBNMzcsMTJMMzcsMTJjLTUuNywwLTguNywzLjYtMTAuOSw4YzAuNCwwLjgsMC43LDEuNiwxLjEsMi40CgljMi4xLTQuNiw0LjYtOC40LDkuOC04LjRjNi4xLDAsMTEsNC45LDExLDExYzAsMCwwLDAsMCwwYzAsNi4wNjUtNC45MzUsMTEtMTEsMTFjLTYuMzMzLDAtOC42MzgtNS41My0xMS4wNzctMTEuMzg1CglDMjMuMzM5LDE4LjQxMywyMC42NjcsMTIsMTMsMTJDNS44MzIsMTIsMCwxNy44MzIsMCwyNWMwLDcuMiw1LjgsMTMsMTMsMTNjNS43LDAsOC43LTMuNiwxMC45LTguMWMtMC40LTAuOC0wLjctMS42LTEuMS0yLjQKCUMyMC43LDMyLjIsMTguMiwzNiwxMywzNkM2LjksMzYsMiwzMS4xLDIsMjVjMC02LjA2NSw0LjkzNS0xMSwxMS0xMWM2LjMzMywwLDguNjM4LDUuNTMsMTEuMDc3LDExLjM4NQoJQzI2LjY2MSwzMS41ODcsMjkuMzMzLDM4LDM3LDM4YzcuMTY4LDAsMTMtNS44MzIsMTMtMTNoMEM1MCwxNy44LDQ0LjIsMTIsMzcsMTJ6Ij48L3BhdGg+Cjwvc3ZnPg==" style="height: 50px;" />' : $row->event_amount_member).'</div>
										Plätze gesamt
									</td>
								</tr>
							</table>
						</div>
						<div class="section-footer">
							<table style="width: 100%; border-collapse: 0; border-spacing: 0;">
								<tr>
									<td style="width: 50%;">
										<button class="modal" data-title="Event bearbeiten" data-type="url" data-source="/ajax/modal/edit_event/'.$row->event_id.'/">Bearbeiten</button>
									</td>
									<td style="width: 50%;">
										<form methode="post" data-type="confirm" data-text="Wollen Sie das Event vollständig entfernen?" data-url="/ajax/event/delete_event/'.$row->event_id.'" data-redirect="/" >
											<button class="submit">Löschen</button>
										</form>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>				
			  </div>';
		$v_event_counter++;
	}
	?>
</div>