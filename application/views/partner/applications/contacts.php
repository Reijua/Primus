<div class="container partner-contacts">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/partner/contacts/create-contact">Kontaktperson hinzufügen</a>
	</div>
	<div class="row">
		<?php foreach ($this->Employee->get_employee('filter:company', $this->session->partner['user_id'])->result() as $i => $row): ?>

		<div class="col-md-4 col-sm-6">
			<?php

			// Determine image tag
			if ($row->employee_profile_image_url != NULL) {
				$image = '<img class="media-object dp img-circle" src="'. base_url() . $row->employee_profile_image_url .'">';
			} else {
				$image = '';
			}

			$employee_data = array(
				'gender' => $row->gender_description,
				'title' => ($row->employee_title != NULL ? $row->employee_title : ''),
				'firstname' => $row->employee_firstname,
				'lastname' => $row->employee_lastname,
				'image' => $image,
				'email' => '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $row->user_email .'" target="_blank">'. $row->user_email .'</a>',
				'phone' => ($row->employee_phone != NULL ? '<br /><i class="fa fa-phone fa-fw"></i> '. $row->employee_phone : ''),
			);

			ob_start();

			?>

			<div class="panel-footer functions">
				<a class="btn btn-info btn-xs load-modal" data-source="/partner/contacts/edit-contact/<?= $row->employee_id ?>" role="button">Kontaktperson bearbeiten</a>
				<?php if ($row->employee_id != $this->Partner->get_partner('filter:id', $this->session->partner['user_id'])->first_row()->company_main_contact): ?>
				<a class="btn btn-danger btn-xs load-modal" data-source="/partner/contacts/delete-contact/<?= $row->employee_id ?>" role="button">Kontaktperson löschen</a>
				<?php endif; ?>
			</div>

			<?php

			$employee_data['panel_footer'] = ob_get_clean();

			echo $this->parser->parse('template/profile/employee-card', $employee_data, true);

			?>
		</div>

		<?php endforeach; ?>
	</div>
</div>