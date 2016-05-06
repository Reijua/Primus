<div class="panel panel-default side-ad" id="side-ad-{ad_id}">
	<div class="panel-body">
		<h4>{title}</h4>
		<a href="{url}" target="_blank">{url_text}</a>
		<div class="row">
			<div class="col-xs-5" style="padding-right: 0">
				<div class="media-tag">{media_tag}</div>
			</div>
			<div class="col-xs-7">
				<p>{text}</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	var side_ad_timer_{ad_id};
	
	new Waypoint.Inview({
		element: $('#side-ad-{ad_id}')[0],
		enter: function(direction) {
			side_ad_timer_{ad_id} = setTimeout(function() { addAdView({ad_id}) }, 2000);
		},
		exited: function(direction) {
			clearTimeout(side_ad_timer_{ad_id});
		}
	});
	
	function addAdView(id) {
		if ('{user}' == 'member' && $('#side-ad-{ad_id}').is(':visible')) {
			$.ajax({
				type: 'POST',
				url: '/partner/statistics/add-advertisement-view',
				data: {
					id: id
				}
			});

			console.log('read ad ' + id);
		}
	}
});

</script>