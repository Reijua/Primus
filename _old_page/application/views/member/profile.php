<script type="text/javascript">
$(document).ready(function(){
	$(document).initUI();
});
</script>

<?php 

	$account = $this->M_account_model->get_account("filter:id", $account_id)->row();

?>

<div class="container light-grey">
	<div class="container-content text-center">
		<h1 style="margin: 100px auto;">Profil von <?= $account->member_firstname .' '. $account->member_lastname ?></h1>
	</div>
</div>