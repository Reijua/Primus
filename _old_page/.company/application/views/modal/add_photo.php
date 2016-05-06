<style type="text/css">
.photo-thumbnail{
	position: relative;
	float: left;
	width: 16.66666667%;
	cursor: pointer;
	background-color: #FFFFFF;
}
	.photo-thumbnail .photo-preview{
		height: 200px;
		width: 100%;
		background-repeat:no-repeat;
		background-size: cover;
		background-color: #FFFFFF;
	}
		.photo-thumbnail .photo-preview .settings{
			display: none;
		}
		.photo-thumbnail .photo-preview:hover .settings{
			display: block;
			height: 100%;
			width: 100%;
			background-color: rgba(0,0,0,.4);
		}

.file-selector{
	position: relative;
	float: left;
	width: 16.66666667%;
	height: 200px;
	margin: 0;
	padding: 0;
	border:0;
	cursor: pointer;
	background-color: #FFFFFF;
	text-align: center;
}

	.file-selector i{
		font-size: 50px;
		position: absolute;
		top: 50%;
		left: 50%;
		margin-left: -27px;
		margin-top: -25px;
		color: #CCCCCC;
	}
	.file-selector:hover i{
		color: #777777;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).initFormSystem();
	$("#file").initFilePreview({
		p_target: '.image-preview',
		p_format: '<div class="photo-thumbnail"><div class="photo-preview" style="background-image:url({0}); background-position:center center;"></div></div>'
	});
});
</script>
<div class="column-1" style="overflow:auto;">
	<div class="column-content">
		<div class="image-preview">

		</div>
		<form methode="post" form-url="/ajax/multimedia/add_photo/" form-type="normal" form-redirect="/">
			<div class="file-selector">
				<input type="file" name="file[]" id="file" multiple="multiple" />
				<i class="icon-plus"></i>
			</div>
			
		</form>
	</div>
</div>