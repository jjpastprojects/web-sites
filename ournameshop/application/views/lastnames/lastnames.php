<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="row margin-top">
	<div class="col-lg-12 text-center">
		<div class="letters">
			<a href="/lastnames" class="btn btn-default btn-sm<?php if(!$letter) echo ' active';?>">
				All
			</a>
			
			<?php for($i = 65; $i <= 90; $i++):?>
				<a href="/lastnames/<?php echo chr($i);?>" class="btn btn-default btn-sm<?php if($letter == chr($i)) echo ' active';?>">
					<?php echo chr($i);?>
				</a>
			<?php endfor;?>
		</div>
	</div>
</div>

<div class="row">
	<div class="log-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
		<h2>Full Lastnames List</h2>

		

		<div class="row">
			<?php foreach($lastnames as $lastname):?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 margin-top">
					<a href="/<?php echo ucfirst(mb_strtolower($lastname->lastname));?>">
						<?php echo $lastname->lastname;?>
					</a>
				</div>
			<?php endforeach;?>
		</div>

		<div class="margin-top">
			<?php echo isset($pagination) ? $pagination['links'] : '';?>
		</div>
	</div>
</div>