<script type="text/javascript">
$(document).ready(function () {
	$(this).initFormSystem();
});
</script>
<div class="column-1">
	<div class="column-content">
		<h4>Kategorie erstellen</h4>
		<form methode="post" data-type="normal" data-url="/ajax/news/create_category/" data-redirect="/">
			<table style="width:100%; border-collapse: 0; border-spacing: 0;">
				<tr>
					<td style="min-width: 200px; padding-right:10px;">
						<label>Name</label>
						<input type="text" name="name" id="create_category_name">
					</td>
					<td style="width:100px;"><button class="submit" style="margin-top:14px;">Hinzufügen</button></td>
				</tr>
			</table>
		</form>
	</div>	
</div>
<div class="column-1">
	<div class="column-content">
		<h4>Kategorien</h4>
		<table style="width: 100%; border-collapse:0; border-spacing:0;">
			<?php
			foreach ($this->News_Model->get_category()->result() as $row) {
			echo '
			<tr>
				<td>
					<form methode="post" data-type="normal" data-url="/ajax/news/update_category/" data-redirect="/">
						<table style="width: 100%; border-collapse:0; border-spacing:0;">
							<tr>
								<td>
									<input type="hidden" name="id" value="'.$row->category_id.'" />
									<input type="text" name="name" id="category_name_'.$row->category_id.'" value="'.$row->category_name.'" />
								</td>
								<td class="text-center" style="width: 100px;"><span class="link submit">Bearbeiten</span></td>
							</tr>
						</table>
					</form>
				</td>
				<td class="text-center" style="width:100px">
					<form methode="post" data-type="confirm" data-url="/ajax/news/delete_category/" data-redirect="/" data-text="Wollen Sie die Kategorie \''.$row->category_name.'\' wirklich löschen?">
						<input type="hidden" name="id" value="'.$row->category_id.'" />
						<span class="link submit">Löschen</span>
					</form>
				</td>
			</tr>
			';
			}
			?>
		</table>
	</div>	
</div>
