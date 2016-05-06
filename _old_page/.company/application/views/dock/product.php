<style type="text/css">
.product-thumbnail{
	position: relative;
	width: 100%;
	height: 350px;
	background-color: #FFFFFF;
	background-position: center;
	background-repeat: no-repeat;
	background-size: contain;
}
	.product-thumbnail .container-bottom{
		position: absolute;
		width: 100%;
		bottom: 0px;
		background-color: #3B5999;
		border-top: 2px solid #263962;
	}
		.product-thumbnail .container-bottom .container-content{
			padding: 10px;
			color: #FFFFFF;
		}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
	$(document).modal();
});
</script>
<div class="column-1">
	<div class="column-content">
		<h3>Produkte</h3>
		<div class="option-bar">
			<ul>
				<li class="modal" modal-title="Produkt hinzufügen" modal-type="url" modal-data="/ajax/modal/add_product/">Hinzufügen</li>
			</ul>
		</div>
	</div>
</div>
<?php foreach ($this->Product_Model->get_product($this->session->userdata('account_id'))->result() as $row): ?>
<div class="column-4">
		<div class="column-content">
			<div class="product-thumbnail" style="background-image: url('http://i4.ztat.net/large/VE/12/1C/0I/YQ/11/VE121C0IY-Q11@12.jpg');">
				<div class="container-bottom">
					<div class="container-content">
						<strong><?=$row->product_name?></strong><br />
						<div class="text-right">
							<?=sprintf($this->lang->line('interval_format_'.$row->interval_name), $row->currency_sign, number_format($row->product_price,2,',','.'))?>
						</div>
					</div>
				</div>				
			</div>
			<div style="background-color:#FFFFFF;">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="49%" style="padding-right:1%;">
							<button>Bearbeiten</button>
						</td>
						<td width="49%" style="padding-left:1%;">
							<button>Löschen</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php endforeach; ?>