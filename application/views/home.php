<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="hero">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 text-center">
				<p>
					Werde jetzt Mitglied und <br />
					profitiere von unserem <br />
					umfangreichen Netzwerk!
				</p>
				<a class="btn btn-primary btn-lg" href="/member/register" role="button">Jetzt anmelden!</a>
			</div>
			<div class="col-xs-6 hidden-xs hidden-sm">
				<img src="<?= asset_url('images/layout/suits.png') ?>">
			</div>
		</div>
	</div>
</div>

<div class="fact-boxes">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="fact">
					<div class="image">
						<img src="<?= asset_url('images/layout/facts/network.png') ?>">
					</div>
					<div class="text">
						<h3>Netzwerk</h3>
						<p>
							Werde Teil eines einzigartigen Netzwerks. Es spielt keine Rolle in welcher Branche du beruflich tätig bist. Genieße einfach die Vorteile vom Primus Romulus Netzwerk!
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="fact">
					<div class="image">
						<img src="<?= asset_url('images/layout/facts/jobs.png') ?>">
					</div>
					<div class="text">
						<h3>Jobangebote</h3>
						<p>
							Du bist gerade frisch mit der HTBLA Kaindorf fertig geworden und suchst einen Arbeitsplatz? Wir haben das eine oder andere Jobangebot, was für dich interessant sein könnte.
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="fact">
					<div class="image">
						<img src="<?= asset_url('images/layout/facts/events.png') ?>">
					</div>
					<div class="text">
						<h3>Veranstaltungen</h3>
						<p>
							Durch interessante Vorträge, kulinarische Köstlichkeiten aus der Region und unterhaltsame Freizeitaktivitäten wollen wir die Interessen unserer Mitglieder widerspiegeln und sie dadurch auch weiterbilden.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="news">
	<div class="container">
		<div class="header">
			<h1><i class="fa fa-comments-o"></i> Neuigkeiten</h1>
		</div>
		<div id="news-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
			<div class="carousel-inner">
				<?php 

				$length = count($this->News->get_news('all')->result());

				foreach ($this->News->get_news('all')->result() as $i => $row): 

				?>
				
				<?php if ($i % 2 == 0): ?>

				<div class="item <?= ($i == 0 ? 'active' : '') ?>">
					<div class="row">

				<?php endif; ?>

						<div class="col-xs-8 col-md-5 col-xs-offset-2 <?= ($i % 2 == 0 ? 'col-md-offset-1' : 'col-md-offset-0') ?>">
							<div class="news-item">
								<div class="image">
									<div class="image" style="background-image: url('<?= base_url() . $row->news_banner_image_url ?>')"></div>
								</div>
								<div class="caption">
									<h3><?= $row->news_title ?></h3>
									<p><?= word_limiter($row->news_text, 25) ?></p>
									<div class="text-center">
										<a href="/news/details/<?= $row->news_id ?>" class="btn btn-primary" role="button">Weiterlesen</a>
									</div>
								</div>
							</div>
						</div>

				<?php if (($i + 1) % 2 == 0 || $i == $length - 1): ?>

					</div>
				</div>

				<?php endif; ?>

				<?php endforeach; ?>
			</div>
			<a class="left carousel-control" href="#news-carousel" data-slide="prev"><i class="fa fa-chevron-left fa-2x"></i></a>
			<a class="right carousel-control" href="#news-carousel" data-slide="next"><i class="fa fa-chevron-right fa-2x"></i></a>
		</div>
	</div>
</div>

<div class="partners">
	<div class="container">
		<div class="header">
			<h1><i class="fa fa-users"></i> Partner</h1>
		</div>
		<div class="row">
			<?php foreach ($this->Partner->get_partner('all')->result() as $i => $row): ?>
			<div class="col-sm-4">
				<a href="/profile/partner/<?= $row->company_id ?>" title="<?= $row->company_name ?>">
					<div class="partner">
						<img src="<?= base_url() . $row->company_logo_image_url ?>">
					</div>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>