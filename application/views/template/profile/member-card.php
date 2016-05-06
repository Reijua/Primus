{html_before}
<div class="member-card">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="media">
				<div class="pull-left">
					{image}
				</div>
				<div class="media-body">
					{gender}
					<h4 class="media-heading">{title} {firstname} {lastname}</h4>
					<hr style="margin: 8px auto 5px">
					{class}
					{email}
				</div>
			</div>
		</div>
	</div>
</div>
{html_after}
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
});

</script>