<div class="container <?php if(!empty($company_website) || !empty($company_facebook) || !empty($company_google_plus) || !empty($company_linkedin) || !empty($company_twitter) || !empty($company_xing) || !empty($company_youtube)) echo "navbar-margin"; ?>">
	<div class="row">
		<div class="col-md-5 col-md-push-7">
			<?php 
			//rechts
			// Determine website
			if ($location_website != NULL) {
				$website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($location_website) .'">'. $location_website .'</a><br />';
			} else if ($company_website != NULL) {
				$website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($company_website) .'">'. $company_website .'</a><br />';
			} else {
				$website = '';
			}

			?>
			<div class="panel panel-primary main-location">
				<div class="panel-heading">Hauptstandort</div>
				<div class="panel-body">
					<?= $company_logo_image_url != NULL ? '<img src="'. base_url() . $company_logo_image_url .'">' : '' ?>
					<div class="location">
						<div class="address">
							<h4><?= $company_name ?></h4>
							<?= $location_name ?><br />
							<?= $address_street ?><br />
							<?= $address_zipcode ?> <?= $address_city ?><br />
							<?= $country_name ?>
						</div>
						<div class="more-info">
							<?= ($location_phone != NULL ? '<i class="fa fa-phone fa-fw"></i> '. $location_phone .'<br />' : '') ?>
							<?= ($location_fax != NULL ? '<i class="fa fa-fax fa-fw"></i> '. $location_fax .'<br />' : '') ?>
							<?= ($location_email != NULL ? '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $location_email.'">'. $location_email .'</a><br />' : '') ?>
							<?= $website ?>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			$query = $this->Location->get_location('filter:notmainlocation', $company_id);
			
			foreach($query->result() as $location)
			{
				if ($location->location_website != NULL) {
					$website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($location_website) .'">'. $location->location_website .'</a><br />';
				} else if ($location->company_website != NULL) {
					$website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($company_website) .'">'. $location->company_website .'</a><br />';
				} else {
					$website = '';
				}

				?>
				<div class="panel panel-primary main-location">
					<div class="panel-heading">Standort</div>
					<div class="panel-body">
						<div class="location">
							<div class="address">
								<h4><?= $location->company_name ?></h4>
								<?= $location->location_name ?><br />
								<?= $location->address_street ?><br />
								<?= $location->address_zipcode ?> <?= $location->address_city ?><br />
								<?= $location->country_name ?>
							</div>
							<div class="more-info">
								<?= ($location->location_phone != NULL ? '<i class="fa fa-phone fa-fw"></i> '. $location->location_phone .'<br />' : '') ?>
								<?= ($location->location_fax != NULL ? '<i class="fa fa-fax fa-fw"></i> '. $location->location_fax .'<br />' : '') ?>
								<?= ($location->location_email != NULL ? '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'.$location->location_email.'">'. $location->location_email .'</a><br />' : '') ?>
								<?= $website ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
			
		</div>
		<div class="col-md-7 col-md-pull-5">
			<?php 
			//links
			if ($company_main_contact != NULL)
			{
				// Get employee data
				$query = $this->Employee->get_employee('filter:id', $company_main_contact);

				// The employee was found
				if ($query->num_rows() == 1)
				{
					$employee = $query->first_row();

					// Determine image tag
					if ($employee->employee_profile_image_url != NULL) {
						$image = '<img class="media-object dp img-circle" src="'. base_url() . $employee->employee_profile_image_url .'">';
					} else {
						$image = '';
					}

					$employee_data = array(
						'gender' => $employee->gender_description,
						'title' => ($employee->employee_title != NULL ? $employee->employee_title : ''),
						'firstname' => $employee->employee_firstname,
						'lastname' => $employee->employee_lastname,
						'image' => $image,
						'email' => '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $employee->user_email .'" target="_blank">'. $employee->user_email .'</a>',
						'phone' => ($employee->employee_phone != NULL ? '<br /><i class="fa fa-phone fa-fw"></i> '. $employee->employee_phone : ''),
						'panel_footer' => '',
					);

					?>

					<div class="panel panel-primary main-contact">
						<div class="panel-heading">Hauptkontaktperson</div>
						<div class="panel-body">
							<?= $this->parser->parse('template/profile/employee-card', $employee_data, true); ?>
						</div>
					</div>

			<?php 
				}
			}
			// Get employee data
			$query = $this->Employee->get_employee('filter:notmainemp', $company_id);
			
			foreach($query->result() as $employee)
			{
				// Determine image tag
				if ($employee->employee_profile_image_url != NULL) {
					$image = '<img class="media-object dp img-circle" src="'. base_url() . $employee->employee_profile_image_url .'">';
				} else {
					$image = '';
				}

				$employee_data = array(
					'gender' => $employee->gender_description,
					'title' => ($employee->employee_title != NULL ? $employee->employee_title : ''),
					'firstname' => $employee->employee_firstname,
					'lastname' => $employee->employee_lastname,
					'image' => $image,
					'email' => '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $employee->user_email .'" target="_blank">'. $employee->user_email .'</a>',
					'phone' => ($employee->employee_phone != NULL ? '<br /><i class="fa fa-phone fa-fw"></i> '. $employee->employee_phone : ''),
					'panel_footer' => '',
				);

				?>

				<div class="panel panel-primary main-contact">
					<div class="panel-heading">Kontaktperson</div>
					<div class="panel-body">
						<?= $this->parser->parse('template/profile/employee-card', $employee_data, true); ?>
					</div>
				</div>

			<?php 
			}
			?>
		</div>
	</div>
</div>