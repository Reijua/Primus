<div class="job-details">
	<div class="heading">
		<div class="container">
			<h2>{job_title} <small>bei <a href="/profile/partner/{company_id}">{company_name}</a></small></h2>
			<div class="lead-text">{job_lead_text}</div>
		</div>
	</div>
	<div class="body">
		<div class="container">
			{job_open}
			<div class="text">{job_text}</div>
			<div class="row">
				<div class="col-md-4">
					<h3>Aufgaben</h3>
					<ul>
					{job_tasks}
						<li>{task}</li>
					{/job_tasks}
					</ul>
				</div>
				<div class="col-md-4">
					<h3>Anforderungen</h3>
					<ul>
					{job_requirements}
						<li>{requirement}</li>
					{/job_requirements}
					</ul>
				</div>
				<div class="col-md-4">
					<h3>Gehaltsangabe</h3>
					{job_salary_text}
					<h3>Eintrittsdatum</h3>
					ab {job_date}
				</div>
			</div>
			<div class="row second-row">
				<div class="col-md-4 col-md-offset-3 col-md-push-5">
					<div class="location">
						<h3>Dienstort</h3>
						<div class="address">
							<strong>{company_name}</strong><br />
							{location_name}<br />
							{location_street}<br />
							{location_zipcode} {location_city}<br />
							{location_country}
						</div>
						<div class="more-info">
							{location_phone}
							{location_fax}
							{location_email}
							{location_website}
						</div>
					</div>
				</div>
				<div class="col-md-5 col-md-pull-7">
					{contact}
				</div>
			</div>
		</div>
	</div>
</div>