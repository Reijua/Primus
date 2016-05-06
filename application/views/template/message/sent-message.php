<div class="close-icon">
	<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span> <span class="text">Schließen</span></button>
</div>
<div style="clear: both;"></div>
<div class="message">
	<div class="media">
		<div class="pull-left">
			{image}
		</div>
		<div class="media-body">
			{gender}
			<h4 class="media-heading">{title} {firstname} {lastname}</h4>
			<hr style="margin: 8px auto 5px">
			{class}
			{date}
		</div>
	</div>

	<div class="content">
		<h3>{subject}</h3>
		{text}
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('.close').click(function(e) {
		e.stopImmediatePropagation();

		closeMessage();

		return;
	});
});

</script>