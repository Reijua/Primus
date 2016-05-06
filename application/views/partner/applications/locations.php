<div class="container partner-locations">
	<div class="main-functions">
		<a class="btn btn-default load-modal" role="button" data-source="/partner/locations/create-location">Standort hinzufügen</a>
	</div>
	<div class="row">
		<?php foreach ($this->Location->get_location('filter:company', $this->session->partner['user_id'])->result() as $i => $row): ?>

		<div class="col-md-4 col-sm-6">
			<div class="wrapper" style="height: 500px">
				<div class="panel panel-default location">
					<div class="panel-body">
						<div class="map">
							<div id="google-map-<?= $row->location_id ?>" class="google-map" data-address="<?= $row->address_street ?>, <?= $row->address_zipcode ?> <?= $row->address_city ?>, <?= $row->country_name ?>" style="height: 250px"></div>
						</div>
						<div class="content">
							<strong><?= $row->location_name ?></strong><br />
							<?= $row->address_street ?><br />
							<?= $row->address_zipcode ?> <?= $row->address_city ?><br />
							<?= $row->country_name ?>
							<div class="more-info">
								<?= ($row->location_phone != NULL ? '<i class="fa fa-phone fa-fw"></i> '. $row->location_phone .'<br />' : '') ?>
								<?= ($row->location_fax != NULL ? '<i class="fa fa-fax fa-fw"></i> '. $row->location_fax .'<br />' : '') ?>
								<?= ($row->location_email != NULL ? '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $row->location_email .'">'. $row->location_email .'</a><br />' : '') ?>
								<?= ($row->location_website != NULL ? '<i class="fa fa-globe fa-fw"></i>  <a href="'. prep_url($row->location_website) .'">'. $row->location_website .'</a><br />' : '') ?>
							</div>
						</div>
					</div>
					<div class="panel-footer functions">
						<a class="btn btn-info btn-xs load-modal" data-source="/partner/locations/edit-location/<?= $row->location_id ?>" role="button">Standort bearbeiten</a>
						<?php if ($row->location_id != $this->Partner->get_partner('filter:id', $this->session->partner['user_id'])->first_row()->company_main_location): ?>
						<a class="btn btn-danger btn-xs load-modal" data-source="/partner/locations/delete-location/<?= $row->location_id ?>" role="button">Standort löschen</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php endforeach; ?>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	// Google Maps
	function initializeMaps() {
		var geocoder = new google.maps.Geocoder();

		$('.google-map').each(function(index) {
			var mapElement = $(this);

			var address = mapElement.data('address');
			var id = mapElement.attr('id');
			var parent = mapElement.parent();

			geocoder.geocode({'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var latitude = results[0].geometry.location.H;
					var longitude = results[0].geometry.location.L;

					var position = new google.maps.LatLng(latitude, longitude);

					var mapOptions = {
						zoom: 12,
						scrollwheel: true,
						center: position
					};

					var map = new google.maps.Map(document.getElementById(id), mapOptions);
					var marker = new google.maps.Marker({
						position: position,
						map: map
					});
				} else {
					mapElement.html('<div class="map-not-found">Für die angegebene Adresse wurden keine passenden Karten-Daten gefunden.<div class="address">' + address + '</div></div>');
				}
			});
		});
	}

	google.maps.event.addDomListener(window, 'load', initializeMaps);
});

</script>