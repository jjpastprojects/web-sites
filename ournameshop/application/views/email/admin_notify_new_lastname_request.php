<p>Greetings!</p>

<p>
	<?php echo "$firstname $lname";?> has requested new lastname: <strong><?php echo mb_strtoupper($lname);?>
</p>

<p>
	<a href="<?php echo site_url('admin');?>/lastname_requests">
		Go to admin panel
	</a>
</p>