<p>Greetings <?php echo $request->firstname;?>!</p>

<p>
	Your family shop is ready.<br />
	<a href="<?php echo site_url() . humanize($request->lastname);?>">
		<?php echo site_url() . humanize($request->lastname);?>
	</a>
</p>