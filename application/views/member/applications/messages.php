<div class="container messages">
	<?php if ($this->Message->get_message('filter:recipient', $this->session->member['user_id'])->num_rows() <= 0): ?>
	<div class="text-center">
		Es wurden keine Nachrichten für dich gefunden!
	</div>
	<?php else: ?>
	<div class="row">
		<div id="message-list" class="col-md-4 col-xs-12">
			<div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Posteingang</a>
					</li>
					<li role="presentation">
						<a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Gesendete Elemente</a>
					</li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="inbox">
					<?php 

					foreach ($this->Message->get_message('filter:recipient', $this->session->member['user_id'])->result() as $i => $row): 

						$sender = $this->Member->get_member('filter:id', $row->message_sender_id)->first_row();

					?>

						<div class="message-card <?= ($row->message_read == 0 ? 'unread' : '') ?>" data-source="/member/messages/get-received-message/<?= $row->message_id ?>">
							<div class="date">
								<?= date('d.m.Y H:i', strtotime($row->message_date_sent)) ?>
							</div>
							<div class="sender">
								<?= $sender->member_firstname .' '. $sender->member_lastname ?>
							</div>
							<div class="subject">
								<?= $row->message_subject ?>
							</div>
							<div class="text-preview">
								<?= character_limiter($row->message_text, 50) ?>
							</div>
						</div>

					<?php endforeach; ?>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="sent">
					<?php 

					foreach ($this->Message->get_message('filter:sender', $this->session->member['user_id'])->result() as $i => $row): 

						$recipient = $this->Member->get_member('filter:id', $row->message_recipient_id)->first_row();

					?>

						<div class="message-card" data-source="/member/messages/get-sent-message/<?= $row->message_id ?>">
							<div class="date">
								<?= date('d.m.Y H:i', strtotime($row->message_date_sent)) ?>
							</div>
							<div class="recipient">
								<?= $recipient->member_firstname .' '. $recipient->member_lastname ?>
							</div>
							<div class="subject">
								<?= $row->message_subject ?>
							</div>
							<div class="text-preview">
								<?= character_limiter($row->message_text, 50) ?>
							</div>
						</div>

					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div id="message-content" class="col-md-8 col-xs-12 hidden">
			<div class="spinner">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<script type="text/javascript">

function findBootstrapEnvironment() {
	var envs = ['xs', 'sm', 'md', 'lg'];

	$el = $('<div>');
	$el.appendTo($('body'));

	for (var i = envs.length - 1; i >= 0; i--) {
		var env = envs[i];

		$el.addClass('hidden-'+env);
		if ($el.is(':hidden')) {
			$el.remove();
			return env
		}
	};
}

function closeMessage() {
	$('#message-content').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
	$('#message-content').addClass('hidden');
	$('#message-list').removeClass('hidden');
}

$(document).ready(function() {
	var resetContent = $('#message-content').html();

	$('.message-card').click(function(e) {
		e.stopImmediatePropagation();

		var myself = $(this);

		$('#message-content').html(resetContent);
		$('#message-content').removeClass('hidden');
		
		if ($.inArray(findBootstrapEnvironment(), ['xs', 'sm']) != -1) {
			$('#message-list').addClass('hidden');
		}

		var source = myself.data('source');

		$.ajax({
			type: 'POST',
			url: source,
			data: {},
			success: function(data) {
				$('#message-content').html(data);
				myself.removeClass('unread');
			}
		});

		return;
	});
});

</script>