<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form TbActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-wysihtml5.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/wysihtml5-0.3.0.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-wysihtml5.min.js");

Yii::app()->clientScript->registerScript('listing-form', "
    jQuery(document).ready(function() {
        var review = '" . get_class($model) . "_review". "';
        $('#' + review).wysihtml5({'html': true});
        $('.wysihtml5-toolbar').hide();
    });
");

$listingModels = Listing::model()->findAll();
$listingData = CHtml::listData($listingModels, 'listing_id', 'name');
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'review-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model, 'listing_id', $listingData, array('span' => 5)); ?>

    <div class="control-group">
        <label class="control-label required">
            <?php echo CHtml::encode($model->getAttributeLabel('ease_of_use')); ?>
            <span class="required">*</span>
        </label>
        <div class="controls">
            <?php
            $this->widget('ext.DzRaty.DzRaty', array(
                'model' => $model,
                'attribute' => 'ease_of_use',
            ));
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label required">
            <?php echo CHtml::encode($model->getAttributeLabel('features')); ?>
            <span class="required">*</span>
        </label>
        <div class="controls">
            <?php
            $this->widget('ext.DzRaty.DzRaty', array(
                'model' => $model,
                'attribute' => 'features',
            ));
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label required">
            <?php echo CHtml::encode($model->getAttributeLabel('client_support')); ?>
            <span class="required">*</span>
        </label>
        <div class="controls">
            <?php
            $this->widget('ext.DzRaty.DzRaty', array(
                'model' => $model,
                'attribute' => 'client_support',
            ));
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label required">
            <?php echo CHtml::encode($model->getAttributeLabel('overall_value')); ?>
            <span class="required">*</span>
        </label>
        <div class="controls">
            <?php
            $this->widget('ext.DzRaty.DzRaty', array(
                'model' => $model,
                'attribute' => 'overall_value',
            ));
            ?>
        </div>
    </div>
    
    <?php echo $form->textFieldControlGroup($model, 'title', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textAreaControlGroup($model, 'review', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textFieldControlGroup($model, 'first_name', array('span' => 5, 'maxlength' => 50)); ?>

    <?php echo $form->textFieldControlGroup($model, 'last_name', array('span' => 5, 'maxlength' => 50)); ?>

    <?php echo $form->textFieldControlGroup($model, 'company_name', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 50)); ?>
    
    <?php echo $form->dropDownListControlGroup($model, 'status', array('taken' => 'Review Taken', 'confirmed' => 'Review Confirmed', 'approved' => 'Review Approved'), array('span' => 5)); ?>
    
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