<style type="text/css">
	.members {
		width: 100%;
		border-collapse: collapse;
		margin-bottom: 30px;
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
		$(this).initFormSystem();
		$(this).modal();
	});

	function filter() {
		var name = ($('.filter_name').val() == "" ? "XALLX" : $('.filter_name').val());
		var company = $('.filter_company').val();
		var klass = $('.filter_class').val();

	    $.ajax({
			url: '/ajax/member/get_member_with_name/' + name + '/' + company + '/' + klass + '/',
			async: true,
			type: "POST",
			dataType: "html"
		}).done(function(data) {
			try {
				data = JSON.parse(data);

				if (data.error) {
					alert(data.message);
				}
			} catch(e) {
				$('.filter-result').html(data);
			}
		});
	}
</script>

<div class="application-header">
	<div class="application-headline">
		<h3>Absolventen suchen</h3>
	</div>
</div>
<div class="application-content">
	<div class="column-1">
		<div class="column-content">
			<div class="container light-grey">
				<div class="container-content filter-result">
					<?php 
					if ($this->Member_Model->get_account('all')->num_rows() != 0) {  ?>
					<table class="members">
						<tr class="filter">
							<form method="post">
								<td class="name">
									<input type="text" class="filter_name">
								</td>
								<td class="company">
									<select class="filter_company">
										<option value="XALLX">alle</option>
										<option value="1">Primus Romulus e. V.</option>
										<option value="2">C&P Immobilien AG</option>
									</select>
								</td>
								<td class="class">
									<select class="filter_class">
										<option value="XALLX">alle</option>
										<option value="1">2011</option>
										<option value="2">2012</option>
										<option value="3">2013</option>
										<option value="4">2014</option>
										<option value="5">2015</option>
									</select>
								</td>
								<td class="action">
									<button class="filter-button" onclick="filter();">Filtern</button>
								</td>
							</form>
						</tr>
						<tr>
							<th>Absolvent</th>
							<th>Beschäftigt bei</th>
							<th>Jahrgang</th>
							<th>Kontakt</th>
						</tr>
						<?php foreach ($this->Member_Model->get_account('all')->result() as $row) { ?>
							<tr class="member">
								<td class="name">
									<a href="/member/<?=  $row->member_id  ?>/profile">
										<img src="<?= $this->Member_Model->get_profile_picture($resource_url, $row->member_profile_image, $row->gender_id) ?>">
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
		</div>
	</div>
</div>