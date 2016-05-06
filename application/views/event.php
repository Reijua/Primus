<div class="event-details">
	<div class="banner">
		<div id="google-map" data-address="<?= $address_street ?>, <?= $address_zipcode ?> <?= $address_city ?>, <?= $country_name ?>" style="height: 300px"></div>
	</div>
	<div class="container">
		<?php if ($this->session->member['logged_in']): ?>
			<?php if ($this->Event->is_participant($event_id, $this->session->member['member_id'])): ?>
			<div class="row">
				<div class="col-xs-8 col-sm-9">
					<h1><?= $event_name ?></h1>
				</div>
				<div class="col-xs-4 col-sm-3">
					<div class="functions">
						<a class="participate btn btn-danger" role="button">Absagen</a>
					</div>
				</div>
			</div>
			<?php elseif($this->Event->get_max_member($event_id) > $this->Event->get_participants($event_id)->num_rows()): ?>
			<div class="row">
				<div class="col-xs-8 col-sm-9">
					<h1><?= $event_name ?></h1>
				</div>
				<div class="col-xs-4 col-sm-3">
					<div class="functions">
						<a class="participate btn btn-success" role="button">Teilnehmen</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<?php else: ?>
			<h1><?= $event_name ?></h1>
		<?php endif; ?>
		<hr style="margin: 8px auto 5px">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="details">
					<i class="fa fa-star fa-fw"></i> <?= $eventtype_name ?><br />
					<i class="fa fa-user fa-fw"></i> <?= $this->User->get_user_name($leader_id) ?><br />
					<i class="fa fa-clock-o fa-fw"></i> <?= date('d.m.Y H:i', strtotime($event_start_date)) . (strtotime($event_end_date) != 0 ? ' - '. date('d.m.Y H:i', strtotime($event_end_date)) : '') ?><br />
					<i class="fa fa-map-marker fa-fw"></i> <?= $address_city ?> <a id="ext-google-map" target="_blank">(auf der Karte anzeigen)</a><br />
				</div>
				<hr style="margin: 8px auto 5px">
				<p><?= nl2br($event_description) ?></p>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="participants">
					<h4><?= $this->Event->get_participant_count($event_id) ?> Teilnehmer (Max. <?= $this->Event->get_max_member($event_id) ?>)</h4>
					<?php
					
					foreach ($this->Event->get_participants($event_id)->result() as $i => $row):
						if ($row->member_profile_image_url != NULL):

					?>

						<img <?= ($this->session->member['member_id'] == $row->member_id ? 'class="you"' : '') ?> data-toggle="tooltip" data-placement="top" title="<?= $row->member_firstname .' '. $row->member_lastname ?><?= ($this->session->member['member_id'] == $row->member_id ? ' (Du)' : '') ?>" src="<?= base_url() . $row->member_profile_image_url ?>">

					<?php else: ?>
						
						<img <?= ($this->session->member['member_id'] == $row->member_id ? 'class="you"' : '') ?> data-toggle="tooltip" data-placement="top" title="<?= $row->member_firstname .' '. $row->member_lastname ?><?= ($this->session->member['member_id'] == $row->member_id ? ' (Du)' : '') ?>" src="<?= asset_url('images/placeholder/'. $row->gender_salutation .'.png') ?>">
					
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	<?php if ($this->session->member['logged_in']): ?>
	$('.participate').click(function(e) {
		e.stopImmediatePropagation();
		
		var data = new FormData();
		data.append('form', true);
		data.append('event', <?= $event_id ?>);
		data.append('member', <?= $this->session->member['member_id'] ?>);

		$.ajax({
			type: 'POST',
			url: '/event/participate',
			data: data,
			contentType: false,
			processData: false,
			success: function(data) {
				location.reload();
			}
		});

		return false;
	});
	<?php endif; ?>

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

	// Google Maps
	function initializeMap() {
		var geocoder = new google.maps.Geocoder();
		var mapElement = $('#google-map');

		var address = mapElement.data('address');
		var id = mapElement.attr('id');
		var parent = mapElement.parent();

		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.H;
				var longitude = results[0].geometry.location.L;

				$('#ext-google-map').attr('href', 'https://www.google.com/maps/place/<?= $address_street ?>,+<?= $address_zipcode ?>+<?= $address_city ?>,+<?= $country_name ?>/@' + latitude + ',' + longitude + ',11z/');

				var position = new google.maps.LatLng(latitude, longitude);

				var mapOptions = {
					zoom: 11,
					scrollwheel: false,
					draggable: false,
					center: position
				};

				var map = new google.maps.Map(document.getElementById(id), mapOptions);
				var marker = new google.maps.Marker({
					position: position,
					map: map
				});
			} else {
				mapElement.html('<div class="map-not-found">Für die angegebene Adresse wurden keine passenden Karten-Daten gefunden.<div class="address"><?= $address_street ?><br><?= $address_zipcode ?> <?= $address_city ?><br><?= $country_name ?></div></div>');
			}
		});
	}

	google.maps.event.addDomListener(window, 'load', initializeMap);
});

</script>