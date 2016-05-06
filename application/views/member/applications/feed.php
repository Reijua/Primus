<div class="container">
	<div class="row">
		<div class="col-md-5 col-md-push-7">
			<?php 

			foreach ($this->Advertisement->get_advertisement('filter:active')->result() as $i => $row) {
				$data = array(
					'user' => 'member',
					'ad_id' => $row->advertisement_id,
					'title' => $row->advertisement_title,
					'url' => $row->advertisement_url,
					'url_text' => $row->advertisement_url_text,
					'media_tag' => !empty($row->advertisement_image_url ) ? '<img src="'. base_url() . $row->advertisement_image_url .'">' : '',
					'text' => nl2br($row->advertisement_text),
				);

				echo $this->parser->parse('template/feed/side-ad', $data, true);
			}

			?>
		</div>
		<div class="col-md-7 col-md-pull-5">
			<?php 

			foreach ($this->Event->get_upcoming_events()->result() as $i => $row) {
				$data = array(
					'event_id' => $row->event_id,
					'date' => date('d.m.Y H:i', strtotime($row->event_start_date)) . (strtotime($row->event_end_date) != 0 ? ' - '. date('d.m.Y H:i', strtotime($row->event_end_date)) : ''),
					'title' => $row->event_name,
					'description' => character_limiter(nl2br($row->event_description), 100),
					'street' => $row->address_street,
					'zipcode' => $row->address_zipcode,
					'city' => $row->address_city,
					'country' => $row->country_name,
				);

				echo $this->parser->parse('template/feed/event', $data, true);
			}

			foreach ($this->Feed->get_post('all')->result() as $i => $row) {
				$array = explode('/', $row->post_attachment_url);
				$name = $array[sizeof($array)-1];
				$data = array(
					'user' => 'member',
					'post_id' => $row->post_id,
					'date' => date('d.m.Y', strtotime($row->post_date_added)),
					'author' => $row->company_name,
					'author_url' => '/profile/partner/'. $row->company_id,
					'title' => $row->post_title,
					'media_tag' => !empty($row->post_image_url) ? '<img src="'. base_url() . $row->post_image_url .'">' : '',
					'file' => !empty($row->post_attachment_url) ? '<div class="feed-attachment"><a target="_blank" href="' . base_url() . $row->post_attachment_url .'"><i class="fa fa-folder" style="margin-right: 8px; font-size: 18px;"></i>'. $name .'</a></div>' : '',
					'video' => !empty($row->post_video_url) ? '<video width="100%" controls><source src="'. base_url() . $row->post_video_url .'" type="video/mp4">Your browser does not support HTML5 video!</video>' : '',
					'text' => nl2br($row->post_text),
				);

				echo $this->parser->parse('template/feed/post', $data, true);
			}

			?>
		</div>
	</div>
</div>