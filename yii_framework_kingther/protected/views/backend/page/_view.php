<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('page_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->page_id),array('view','id'=>$data->page_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_name')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo $data->content; ?>
	<br />


</div>