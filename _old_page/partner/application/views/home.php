<div class="banner" style="background-image: url(<?=$this->Account_Model->get_banner($cdn_url, $object_account->company_id) ?>)">
	<table class="partner-logo">
		<tr>
			<td><img src="<?=$this->Account_Model->get_logo($cdn_url, $object_account->company_id) ?>"></td>
		</tr>
	</table>
</div>
<div class="container light-grey">
	<div class="nav-holder">
		<nav>
			<ul>
				<?php
				foreach ($this->Application_Model->get_application($object_account->group_id, "menu")->result() as $row) {
				echo '<li class="application-link'.(($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-category") : $this->config->item("application-category")) == "menu" && ($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-id") : $this->config->item("application-id")) == $row->application_id ? ' active' : '').'" data-application="'.$row->application_id.'" data-application-category="menu">'.($row->application_icon != '' ? '<img src="'.$resource_url.'image/icon/grey/'.$row->application_icon.'" style="height: 13px; width: 13px;"> ' : '').''.$row->application_name.'</li>';
				}
				?>
			</ul>
		</nav>
	</div>
	<div class="container-content" id="application-content" style="min-height:400px;">
	</div>
	<div class="placeholder"></div>
</div>
<div class="container dark-grey">
	<div class="container-content">
		<div class="arrow light-grey"></div>
	</div>
</div>