<?php
/* @var $this FeatureController */
/* @var $model Feature */
/* @var $form TbActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-wysihtml5.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/wysihtml5-0.3.0.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-wysihtml5.min.js");
Yii::app()->clientScript->registerScript('domain-form', "
    jQuery(document).ready(function() {
        var description = '" . get_class($model) . "_description". "';
        $('#' + description).wysihtml5({'html': true});
    });
");
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'feature-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 50)); ?>
    
    <?php echo $form->dropDownListControlGroup($model, 'type', array('category' => 'Category', 'fixed_price' => 'Fixed Price', 'subscription_price' => 'Subscription Price'), array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'display_name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'url_name', array('span' => 5, 'maxlength' => 50)); ?>
    
    <?php echo $form->checkBoxControlGroup($model, 'show_on_overview'); ?>

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