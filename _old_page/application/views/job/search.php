<style type="text/css">
	.jobs {
		width: 100%;
		border-collapse: collapse;
		margin: 30px auto;
	}

	.jobs tr:nth-child(even) {
		background: #fff;
	}

	.jobs tr:nth-child(-n+2) {
		background: #fff;
	}

	.jobs tr td {
		padding: 10px 0px;
	}

	.jobs tr th {
		padding: 10px 0px;
	}

	.jobs a {
		color: #666 !important;
		transition: color 300ms ease-out 0s;
	}

	.jobs a:hover {
		text-decoration: none;
		color: #3B5999 !important;
	}

	.jobs a:hover img {
		box-shadow: 0px 0px 3px 1px rgba(59, 89, 153, 1);
	}

	.jobs .name {
		font-weight: 400;
		font-size: 16px;
		line-height: 14px;
	}

	.jobs .name img {
		width: 40px;
		vertical-align: middle;
		margin: 0px 10px;
		border-radius: 100%;
		transition: box-shadow 300ms ease-out;
	}

	.jobs td:not(.name) {
		text-align: center;
	}

	.jobs .filter input, .jobs .filter select {
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

	.jobs .filter .name input {
		margin-left: 10px;
	}

	.jobs .filter .action button {
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
		<h1 class="text-center" style="margin-top: 30px;">Jobsuche</h1>
		<?php if ($this->Job_Model->get_jobs()->num_rows() != 0) { ?>
		<table class="jobs">
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
					<td class="action">
						<button class="submit">Filtern</button>
					</td>
				</form>
			</tr>
			<tr>
				<th>Beruf</th>
				<th>Kurzbeschreibung</th>
				<th>Gültig bis</th>
			</tr>
			<?php foreach ($this->Job_Model->get_jobs()->result() as $row) { ?>		
			<tr class="member">
				<td class="name">
					<a href="/job/<?= $row->job_id ?>/">
						<?= $row->job_title ?>
					</a>
				</td>
				<td class="company">
					<?= $row->job_preamble ?>
				</td>
				<td class="class">
					<?= ($row->job_close_date = "" ? "Kein Enddatum" : $row->job_close_date) ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
</div>