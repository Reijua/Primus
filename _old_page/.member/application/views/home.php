<script type="text/javascript">
$(document).ready(function(){
	$(document).initUI();
});
</script>
<div class="container">
	<div class="column-left">
		<?php if($this->Application_Model->get_application($object_account->group_id, "menu")->num_rows() != 0 ){ ?>
		<div class="section">
			<ul>
				<li><strong>MENÜ</strong></li>
				<?php
				foreach ($this->Application_Model->get_application($object_account->group_id, "menu")->result() as $row) {
				echo '<li class="application-link'.(($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-category") : $this->config->item("application-category")) == "menu" && ($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-id") : $this->config->item("application-id")) == $row->application_id ? ' active' : '').'" data-application="'.$row->application_id.'" data-application-category="menu">'.($row->application_icon != '' ? '<img src="'.$resource_url.'image/icon/grey/'.$row->application_icon.'" style="height: 13px; width: 13px;"> ' : '').''.$row->application_name.'</li>';
				}
				?>
			</ul>
		</div>
		<?php } ?>
		<?php if($this->Application_Model->get_application($object_account->group_id, "administration")->num_rows() != 0 ){ ?>
		<div class="section">
			<ul>
				<li><strong>ADMINSTRATION</strong></li>
				<?php 
				foreach ($this->Application_Model->get_application($object_account->group_id, "administration")->result() as $row) {
				echo '<li class="application-link'.(($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-category") : $this->config->item("application-category")) == "administration" && ($this->input->cookie("application-category") != NULL ? $this->input->cookie("application-id") : $this->config->item("application-id")) == $row->application_id ? ' active' : '').'" data-application="'.$row->application_id.'" data-application-category="administration">'.($row->application_icon != '' ? '<img src="'.$resource_url.'image/icon/grey/'.$row->application_icon.'" style="height: 13px; width: 13px;"> ' : '').''.$row->application_name.'</li>';
				}
				?>
			</ul>
		</div>
		<?php } ?>
		<div class="spacing"></div>
		<div class="section">
			<div class="section-content">
				<strong>DEINE KLASSE</strong><br />
				<br />
				<div class="portrait">
				<?php
				foreach ($this->Account_Model->get_account("class", $object_account->class_name)->result() as $row) {
					echo '<img class="no-margin" src="'.$this->Account_Model->get_profile_picture($resource_url, $row->member_id, $row->gender_id).'" alt="'.$row->member_firstname.' '.$row->member_lastname.'" style="width:34px; height:34px;" />';
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="column-right">
		
	</div>
</div>