<script type="text/javascript">
$(document).ready(function(){
	$(document).radiobox();
	$(document).initFormSystem();
});
</script>
<div class="column" style="width:96%;margin:0% 2%">
	<h4><?php echo $this->lang->line("tag_language"); ?></h4>
</div>
</div>
<div class="column-2">
	<?php echo $this->lang->line("language_text"); ?>
</div>
<div class="column-2">
	<form form-url="/ajax/account/language/" form-redirect="/" methode="post">
		<?php 
		foreach ($language_data as $row) {
			echo '<div class="column-2"><div class="radio-box"><input type="radio" name="language" text="'.$row->language_description.'"" value="'.$row->language_tag.'" '.(($this->input->cookie("language")==null?'enGB':$this->input->cookie("language"))==$row->language_tag ? 'checked="checked"' : '').' /></div></div>';
		} 
		?>
		<div class="column" style="width:96%;margin:0 2%;padding:1% 0;border-top:1px solid #CCCCCC;">
			<button id="submit"><?php echo $this->lang->line("language_btn_save"); ?></button>
		</div>
	</form>
</div>

