<?php
/* @var $this FeatureController */
/* @var $data Feature */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->type); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('display_name')); ?>:</b>
    <?php echo CHtml::encode($data->display_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('url_name')); ?>:</b>
    <?php echo CHtml::encode($data->url_name); ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo $data->description; ?>
    <br />

</div>