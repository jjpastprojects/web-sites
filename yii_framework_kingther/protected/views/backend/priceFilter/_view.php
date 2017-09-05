<?php
/* @var $this PriceFilterController */
/* @var $data PriceFilter */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('price_filter_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->price_filter_id),array('view','id'=>$data->price_filter_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_plan')); ?>:</b>
	<?php echo CHtml::encode($data->price_plan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_name')); ?>:</b>
	<?php echo CHtml::encode($data->url_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_price')); ?>:</b>
	<?php echo CHtml::encode($data->start_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_price')); ?>:</b>
	<?php echo CHtml::encode($data->end_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>