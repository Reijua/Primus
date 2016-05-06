<div class="panel panel-primary feed-event">
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-5">
				<div class="map">
					<div id="google-map-{event_id}" class="google-map" data-address="{street}, {zipcode} {city}, {country}" style="height: 250px"></div>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="content">
					<div class="row">
						<div class="col-xs-8 col-sm-9">
							<h4>{title}</h4>
						</div>
						<div class="col-xs-4 col-sm-3">
							<div class="more">
								<a href="/event/details/{event_id}" class="btn btn-primary btn-xs" role="button">Details anzeigen</a>
							</div>
						</div>
					</div>
					<hr style="margin: 2px auto 5px">
					<div class="details">
						<i class="fa fa-clock-o fa-fw"></i> {date}<br />
						<i class="fa fa-map-marker fa-fw"></i> {city} <a id="ext-google-map-{event_id}" target="_blank">(auf der Karte anzeigen)</a><br />
					</div>
					<hr style="margin: 8px auto 5px">
					{description}
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	// Google Maps
	function initializeMap() {
		var geocoder = new google.maps.Geocoder();
		var mapElement = $('#google-map-{event_id}');

		var address = mapElement.data('address');
		var id = mapElement.attr('id');
		var parent = mapElement.parent();

		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.H;
				var longitude = results[0].geometry.location.L;

				$('#ext-google-map-{event_id}').attr('href', 'https://www.google.com/maps/place/{street},+{zipcode}+{city},+{country}/@' + latitude + ',' + longitude + ',11z/');

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
				mapElement.html('<div class="map-not-found">Für die angegebene Adresse wurden keine passenden Karten-Daten gefunden.<div class="address">{street}<br>{zipcode} {city}<br>{country}</div></div>');
			}
		});
	}

	google.maps.event.addDomListener(window, 'load', initializeMap);
});

</script>