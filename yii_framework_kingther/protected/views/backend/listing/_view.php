<?php
/* @var $this ListingController */
/* @var $data Listing */
$featureArray = array();
foreach($data->features as $feature) {
    $featureArray[] = $feature->name;
}
$featureNames = implode(', ', $featureArray);
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
    <?php echo CHtml::encode($data->company_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
    <?php echo CHtml::encode($data->url); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price_plan')); ?>:</b>
    <?php echo CHtml::encode($data->price_plan); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('support_fee')); ?>:</b>
    <?php echo CHtml::encode($data->support_fee); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
    <?php echo CHtml::encode($featureNames); ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo $data->description; ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('review')); ?>:</b>
    <?php
    $this->widget('ext.DzRaty.DzRaty', array(
        'name' => 'overall_rating' . $data->listing_id,
        'value' => $data->review,
        'options' => array(
            'readOnly' => TRUE,
        ),
    ));
    ?>
    <br />


</div>