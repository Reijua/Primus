	<div class="modal fade" id="pr-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document" id="pr-modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bitte warten ...</h4>
				</div>
				<div class="modal-body">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="wrapper-upper">
			<div class="container">
				<div class="row">
					<div class="col-xs-4">
						<div class="pull-left"><img src="<?= asset_url('images/logo/medium_white.png') ?>"></div>
						<div class="pr">Primus Romulus</div>
					</div>
					<div class="col-xs-8">
						<div class="pull-right address">
							<a href="https://goo.gl/maps/VmCRA">Hauptstraße 179, 8141 Unterpremstätten</a> | <a href="mailto:office@primus-romulus.net">office@primus-romulus.net</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapper-lower">
			<div class="container">
				<div class="row">
					<div class="col-xs-4">
						&copy; 2015 by Primus Romulus
					</div>
					<div class="col-xs-8">
						<div class="pull-right">
							<a href="/policies/terms"><?= lang('elements_footer_terms') ?></a> | 
							<a href="/policies/privacy"><?= lang('elements_footer_privacy') ?></a> | 
							<a href="/policies/cookies"><?= lang('elements_footer_cookies') ?></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="hidden-lg hidden-md" style="margin: 8px auto 5px; border-color: rgba(255, 255, 255, .2);">
						Website designed and developed by <a href="http://nitec.at/" target="_blank">niTEC GesbR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>