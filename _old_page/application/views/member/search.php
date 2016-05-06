<style type="text/css">
	.members {
		width: 100%;
		border-collapse: collapse;
		margin: 30px auto;
	}

	.members tr:nth-child(even) {
		background: #fff;
	}

	.members tr:nth-child(-n+2) {
		background: #fff;
	}

	.members tr td {
		padding: 10px 0px;
	}

	.members tr th {
		padding: 10px 0px;
	}

	.members a {
		color: #666 !important;
		transition: color 300ms ease-out 0s;
	}

	.members a:hover {
		text-decoration: none;
		color: #3B5999 !important;
	}

	.members a:hover img {
		box-shadow: 0px 0px 3px 1px rgba(59, 89, 153, 1);
	}

	.members .name {
		font-weight: 400;
		font-size: 16px;
		line-height: 14px;
	}

	.members .name img {
		width: 40px;
		vertical-align: middle;
		margin: 0px 10px;
		border-radius: 100%;
		transition: box-shadow 300ms ease-out;
	}

	.members td:not(.name) {
		text-align: center;
	}

	.members .filter input, .members .filter select {
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

	.members .filter .name input {
		margin-left: 10px;
	}

	.members .filter .action button {
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
		<h1 class="text-center" style="margin-top: 30px;">Absolventen</h1>
		<?php if ($this->M_account_model->get_account('all')->num_rows() != 0) { ?>
		<table class="members">
			<tr class="filter">
				<form method="post" data-url="/ajax/member/get_member_with_name/" data-redirect="/" data-type="normal">
					<td class="name">
						<input type="text" name="filter_name">
					</td>
					<td class="company">
						<select name="filter_company">
							<option>alle</option>
							<option>Primus Romulus e. V.</option>
							<option>C&P Immobilien AG</option>
						</select>
					</td>
					<td class="class">
						<select name="filter_class">
							<option>alle</option>
							<option>2011</option>
							<option>2012</option>
							<option>2013</option>
							<option>2014</option>
							<option>2015</option>
						</select>
					</td>
					<td class="action">
						<button class="submit">Filtern</button>
					</td>
				</form>
			</tr>
			<tr>
				<th>Absolvent</th>
				<th>Beschäftigt bei</th>
				<th>Jahrgang</th>
				<th>Kontakt</th>
			</tr>
			<?php foreach ($this->M_account_model->get_account('all')->result() as $row) { ?>		
			<tr class="member">
				<td class="name">
					<a href="/member/<?= $row->member_id ?>/profile">
						<img src="<?= $this->M_account_model->get_profile_picture($resource_url, $row->member_profile_image, $row->gender_id) ?>">
						<?= $row->member_firstname .' '. $row->member_lastname ?>
					</a>
				</td>
				<td class="company">
					<a href="/partner/1/profile">Primus Romulus e. V.</a>
				</td>
				<td class="class">
					<?= $row->class_name .' / '. $row->class_year ?>
				</td>
				<td class="contact">
					<i class="icon-envelope"></i> <a href="#">Nachricht schreiben</a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
</div>