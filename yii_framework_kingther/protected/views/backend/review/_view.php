<?php
/* @var $this ReviewController */
/* @var $data Review */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('listing_id')); ?>:</b>
    <?php echo CHtml::encode($data->listing->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('review')); ?>:</b>
    <?php echo CHtml::encode($data->review_id); ?>
    <br />


    <b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
    <?php echo CHtml::encode($data->first_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
    <?php echo CHtml::encode($data->last_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
    <?php echo CHtml::encode($data->company_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ease_of_use')); ?>:</b>
    <?php
    $this->widget('ext.DzRaty.DzRaty', array(
        'name' => 'ease_of_use' . $data->review_id,
        'value' => $data->ease_of_use,
        'options' => array(
            'readOnly' => TRUE,
        ),
    ));
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
    <?php
    $this->widget('ext.DzRaty.DzRaty', array(
        'name' => 'features' . $data->review_id,
        'value' => $data->features,
        'options' => array(
            'readOnly' => TRUE,
        ),
    ));
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('client_support')); ?>:</b>
    <?php
    $this->widget('ext.DzRaty.DzRaty', array(
        'name' => 'client_support' . $data->review_id,
        'value' => $data->client_support,
        'options' => array(
            'readOnly' => TRUE,
        ),
    ));
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('overall_value')); ?>:</b>
    <?php
    $this->widget('ext.DzRaty.DzRaty', array(
        'name' => 'overall_value' . $data->review_id,
        'value' => $data->overall_value,
        'options' => array(
            'readOnly' => TRUE,
        ),
    ));
    ?>
    <br />

</div>