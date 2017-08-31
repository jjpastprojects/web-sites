<div class="row print-designer-holder" style="width: 500px;">
	<div class="col-lg-12 text-center">
		<form>
			<input type="file" name="img" class="hidden" />
			<a href="#" class="btn btn-warning choose-photo">Choose Your Photo</a>
			<a href="#" class="btn btn-default preview hidden">Use Print</a>
		</form>

		<div id="uploadPreview" class="margin-top upload-preview">
			<img src="<?php echo tpl_thumb($template, 'low_res_b');?>" alt="" class="logo" />
			<img src="" class="photo hidden" />
		</div>

		<div class="controls margin-top">
			<button class="btn btn-info" data-resize="+">+</button>
			<button class="btn btn-info" data-resize="-">-</button>

			<button class="btn btn-info" data-move="left">left</button>
			<button class="btn btn-info" data-move="right">right</button>
			<button class="btn btn-info" data-move="up">up</button>
			<button class="btn btn-info" data-move="down">down</button>
		</div>
	</div>
</div>