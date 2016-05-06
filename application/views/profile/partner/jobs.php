<div class="container partner-profile <?php if(!empty($company_website) || !empty($company_facebook) || !empty($company_google_plus) || !empty($company_linkedin) || !empty($company_twitter) || !empty($company_xing) || !empty($company_youtube)) echo "navbar-margin"; ?>">
	<div class="job-results">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12" id="job-results">
				<?php

				$query = $this->Job->get_job('filter:company', $company_id);

				// No jobs were found
				if ($query->num_rows() == 0) {
					echo 'Derzeit gibt es keine Jobangebote.';
				}

				foreach ($query->result() as $i => $job) {
					// Skip jobs which are closed
					if ($job->job_open == 0) {
						continue;
					}

					// Format the start date
					$job->job_start_date = DateTime::createFromFormat('Y-m-d', $job->job_start_date)->format('d.m.Y');

					$data = array(
						'company_id' => $job->company_id,
						'company_image_url' => base_url() . $job->company_logo_image_url,
						'company_name' => $job->company_name,
						'job_id' => $job->job_id,
						'job_title' => $job->job_title,
						'job_date' => $job->job_start_date,
						'job_location' => $job->address_city .', '. $job->country_name,
						'job_text' => word_limiter($job->job_text, 35),
					);

					echo $this->parser->parse('template/job/result', $data, true);
				}

				?>
			</div>
		</div>
	</div>
</div>