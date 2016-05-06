<div class="job-result">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="media">
				<div class="hidden-xs" style="display: table-cell; vertical-align: middle;">
					<a href="/profile/partner/{company_id}" target="_blank">
						<?php if ($this->agent->is_browser('Firefox')): ?>
							<img src="{company_image_url}">
						<?php else: ?>
							<img src="{company_image_url}" style="width: 100%; margin-right: 100px; padding-right: 10px;">
						<?php endif; ?>
					</a>
				</div>
				<div class="media-body">
					<h4><a href="/job/details/{job_id}" target="_blank">{job_title}</a></h4>
					<div class="detail">seit {job_date} bei <a href="/profile/partner/{company_id}" target="_blank">{company_name}</a> in {job_location}</div>
					<p>{job_text}</p>
				</div>
			</div>
		</div>
	</div>
</div>