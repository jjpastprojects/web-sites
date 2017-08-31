<div class="row" style="margin-top: 100px;">
	<div class="col-lg-6 col-lg-offset-2">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			    <label>Choose file to be inverted</label>
			    <input required type="file" name="img" />
			</div>

			<button type="submit" class="btn btn-success">Invert</button>
		</form>

		<?php if(isset($img_inverted)):?>
			<div class="row margin-top">
				<div class="col-lg-6">			
					Inverted:<br />
					<img style="width: 100%;background: #bbb;" src="data:image/png;base64,<?php echo $img_inverted;?>" />
				</div>

				<div class="col-lg-6">			
					Original:<br />
					<img style="width: 100%;background: #bbb;" src="data:image/png;base64,<?php echo $img_orig;?>" />
				</div>
			</div>
		<?php endif;?>
	</div>
</div>

