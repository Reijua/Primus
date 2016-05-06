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
			<div class="functions">
				<a class="load-modal" data-source="/member/messages/write-message/{user_id}">
					<i class="fa fa-comments-o"></i> Antworten
				</a>
			</div>
		</div>
	</div>

	<div class="content">
		<h3>{subject}</h3>
		{text}
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	var resetModalContent = $('#pr-modal-content').html();
	$('.load-modal').click(function(e) {
		e.stopImmediatePropagation();

		var source = $(this).data('source');
		
		$('#pr-modal-content').html(resetModalContent);
		$('#pr-modal').modal('show');

		$.ajax({
			type: 'POST',
			url: source,
			data: {},
			success: function(data) {
				$('#pr-modal-content').removeClass('modal-lg');
				$('#pr-modal-content').html(data);
				$('#pr-modal').modal('handleUpdate');
			}
		});

		return false;
	});

	$('.close').click(function(e) {
		e.stopImmediatePropagation();

		closeMessage();

		return;
	});
});

</script>