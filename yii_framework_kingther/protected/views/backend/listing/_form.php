<?php
/* @var $this ListingController */
/* @var $model Listing */
/* @var $form TbActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-select.min.css");
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-wysihtml5.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/wysihtml5-0.3.0.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-wysihtml5.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-select.min.js");
$featureModels = Feature::model()->findAll();
$featureData = CHtml::listData($featureModels, 'feature_id', 'name');
Yii::app()->clientScript->registerScript('listing-form', "
    jQuery(document).ready(function() {
        var features = '" . get_class($model) . "_features" . "';
        $('#' + features).selectpicker();
        var description = '" . get_class($model) . "_description". "';
        $('#' + description).wysihtml5({'html': true});
    });
");
?>

<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'listing-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'url_name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'company_name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'url', array('span' => 5, 'maxlength' => 250)); ?>
    
    <?php echo $form->dropDownListControlGroup($model, 'price_plan', array('fixed_price' => 'Fixed Price', 'subscription_price' => 'Subscription Price', 'other' => 'Other'), array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'price', array('span' => 5)); ?>
    
    <?php echo $form->textFieldControlGroup($model, 'support_fee', array('span' => 5)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'features', $featureData, array('span' => 5, 'multiple' => 'multiple', 'class' => 'selectpicker')); ?>

    <?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 10, 'span' => 8)); ?>

    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->