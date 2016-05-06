<div class="panel panel-primary feed-post" id="feed-post-{post_id}">
	<div class="panel-heading">{date} - <a href="{author_url}">{author}</a></div>
	<div class="panel-body">
		<h2>{title}</h2>
		<div class="media-tag">{media_tag}</div>
		<p>{text}</p>
		{video}
		{file}
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	var feed_post_timer_{post_id};
	
	new Waypoint.Inview({
		element: $('#feed-post-{post_id}')[0],
		enter: function(direction) {
			feed_post_timer_{post_id} = setTimeout(function() { addPostView({post_id}) }, 3000);
		},
		exited: function(direction) {
			clearTimeout(feed_post_timer_{post_id});
		}
	});
	
	function addPostView(id) {
		if ('{user}' == 'member') {
			$.ajax({
				type: 'POST',
				url: '/partner/statistics/add-post-view',
				data: {
					id: id
				}
			});
		}
	}
});

</script>