<style type="text/css">
	. {
		width: 100%;
		border-collapse: collapse;
		margin: 30px auto;
	}

	.partners tr:nth-child(even) {
		background: #fff;
	}

	.partners tr:nth-child(-n+2) {
		backgroundpartners: #fff;
	}

	.partners tr td {
		padding: 10px 0px;
	}

	.partners tr th {
		padding: 10px 0px;
	}

	.partners a {
		color: #666 !important;
		transition: color 300ms ease-out 0s;
	}

	.partners a:hover {
		text-decoration: none;
		color: #3B5999 !important;
	}

	.partners a:hover img {
		box-shadow: 0px 0px 3px 1px rgba(59, 89, 153, 1);
	}

	.partners .name {
		font-weight: 400;
		font-size: 16px;
		line-height: 14px;
	}

	.partners .name img {
		width: 40px;
		vertical-align: middle;
		margin: 0px 10px;
		border-radius: 100%;
		transition: box-shadow 300ms ease-out;
	}

	.partners td:not(.name) {
		text-align: center;
	}

	.partners .filter input, .partners .filter select {
		width: calc(100% - 30px);
		margin: 0 auto;
		font-family: 'Open Sans', Arial, sans-serif;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		height: 35px;
		padding: 0 8px;
		border: 1px solid #CCCCCC;
		background-color: #FFFFFF;
	}

	.partners .filter .name input {
		margin-left: 10px;
	}

	.partners .filter .action button {
		width: calc(100% - 30px);
		margin-left: auto;
		margin-right: 10px;
	}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$(document).initUI();
});
</script>


<div class="container light-grey">
	<div class="container-content">
		<h1 class="text-center" style="margin-top: 30px;">Unternehmen</h1>
		<?php if ($this->Company_Model->get_company('all')->num_rows() != 0) { ?>
		<table class="partners">
			<tr class="filter">
				<td colspan="2">
					<form method="post" data-url="/ajax/member/get_member_with_name/" data-redirect="/" data-type="normal">
						<table style="width: 100%">
						<tr>
							<td class="name">
								<input type="text" name="filter_name">
							</td>
							<td class="action">
								<button class="submit">Filtern</button>
							</td>
						</tr>
						</table>
					</form>
				</td>
				
					
				
			</tr>
			<tr>
				<th>Firmenname</th>
				<th>Beschreibung</th>
			</tr>
			<?php foreach ($this->Company_Model->get_company('all')->result() as $row) { ?>		
			<tr class="member">
				<td class="name">
					<table class="companyname">
					<tr>
						<td colspan="2" class="pictureandname" style="text-align: left">
							<a href="/partner/<?= $row->company_id ?>/profile">
							<img src="<?= $this->Company_Model->get_logo($resource_url, $row->company_id) ?>">
							<?= $row->company_name ?>
							</a>
						</td>
					</tr>
					<tr>
						<td class="address">
							<?= $row->location_address .'<br>'. $row->location_pc .'<nobr>'. $row->location_city ?>
						</td>
						<td class="contact">
							<i class="icon-envelope"></i><a href="mailto:<?= $row->company_email ?>">Nachricht schreiben</a>
						</td>
					</tr>
					</table>
				</td>
				<td class="description">
					<?= $row->company_description ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
</div>