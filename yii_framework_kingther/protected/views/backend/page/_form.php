<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form TbActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-wysihtml5.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/wysihtml5-0.3.0.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-wysihtml5.min.js");

Yii::app()->clientScript->registerScript('page-form', "
    jQuery(document).ready(function() {
        var content = '" . get_class($model) . "_content". "';
        $('#' + content).wysihtml5({'html': true});
    });
");
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'page-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'title', array('span' => 5, 'maxlength' => 100)); ?>
    
    <?php echo $form->textFieldControlGroup($model, 'url_name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textAreaControlGroup($model, 'content', array('rows' => 20, 'span' => 8)); ?>

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