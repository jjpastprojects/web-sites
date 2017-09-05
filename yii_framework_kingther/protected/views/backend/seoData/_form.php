<?php
/* @var $this SeoDataController */
/* @var $model SeoData */
/* @var $form TbActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/bootstrap-tagsinput.css");

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/bootstrap-tagsinput.min.js");

$models = array();

if (isset($model->seo_data_id)) {
    switch ($model->model_name) {
        case 'Page':
            $models = Page::model()->findAll();
            $models = CHtml::listData($models, 'page_id', 'title');
            break;
        case 'Feature':
            $models = Feature::model()->findAll();
            $models = CHtml::listData($models, 'feature_id', 'name');
            break;
        case 'Listing':
            $models = Listing::model()->findAll();
            $models = CHtml::listData($models, 'listing_id', 'name');
            break;
    }
}
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'seo-data-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php
    echo $form->dropDownListControlGroup($model, 'model_name', array('Page' => 'Page', 'Feature' => 'Feature', 'Listing' => 'Listing'), array(
        'prompt' => 'Select Model Name',
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('loadmodels'),
            'update' => '#model',
            'data' => array('model_name' => 'js:this.value'),
        ),
        'span' => 2
    ));
    ?>
    
    <?php
    echo $form->dropDownListControlGroup($model, 'model_id', $models, array(
        'prompt' => 'Select Model',
        'span' => 5,
        'id' => 'model',
        'labelOptions' => array(
            'for' => 'model'
        )
    ));
    ?>

    <?php echo $form->textAreaControlGroup($model, 'title', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 6, 'span' => 8)); ?>

    <?php echo $form->textFieldControlGroup($model, 'keywords', array('span' => 8, 'data-role' => 'tagsinput')); ?>

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