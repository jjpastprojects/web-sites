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
    });
");
?>

<style>
    ul.wysihtml5-toolbar {
        display: none !important;
    }
</style>

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

    <div class="control-group span4 review-rating">
        <div class="row-fluid">
            <div class="span6 text-right">
                <label class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('ease_of_use')); ?></label>
            </div>
            <div class="span6">
                <?php
                $this->widget('ext.DzRaty.DzRaty', array(
                    'model' => $model,
                    'attribute' => 'ease_of_use',
                    'options' => array(
                        'starOff' => 'chiropractic-softwareOff.png',
                        'starOn' => 'chiropractic-softwareOn.png',
                        'starHalf' => 'chiropractic-softwareHalf.png',
                    ),
                ));
                ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6 text-right">
                <label class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('features')); ?></label>
            </div>
            <div class="span6">
                <?php
                $this->widget('ext.DzRaty.DzRaty', array(
                    'model' => $model,
                    'attribute' => 'features',
                    'options' => array(
                        'starOff' => 'chiropractic-softwareOff.png',
                        'starOn' => 'chiropractic-softwareOn.png',
                        'starHalf' => 'chiropractic-softwareHalf.png',
                    ),
                ));
                ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6 text-right">
                <label class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('client_support')); ?></label>
            </div>
            <div class="span6">
                <?php
                $this->widget('ext.DzRaty.DzRaty', array(
                    'model' => $model,
                    'attribute' => 'client_support',
                    'options' => array(
                        'starOff' => 'chiropractic-softwareOff.png',
                        'starOn' => 'chiropractic-softwareOn.png',
                        'starHalf' => 'chiropractic-softwareHalf.png',
                    ),
                ));
                ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6 text-right">
                <label class="control-label"><?php echo CHtml::encode($model->getAttributeLabel('overall_value')); ?></label>
            </div>
            <div class="span6">
                <?php
                $this->widget('ext.DzRaty.DzRaty', array(
                    'model' => $model,
                    'attribute' => 'overall_value',
                    'options' => array(
                        'starOff' => 'chiropractic-softwareOff.png',
                        'starOn' => 'chiropractic-softwareOn.png',
                        'starHalf' => 'chiropractic-softwareHalf.png',
                    ),
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php echo $form->textFieldControlGroup($model, 'title', array('span' => 10, 'maxlength' => 100)); ?>

    <?php echo $form->textAreaControlGroup($model, 'review', array('span' => 10, 'rows' => 6)); ?>

    <div class="row-fluid">
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'first_name', array('span' => 12, 'maxlength' => 50)); ?>
        </div>
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'last_name', array('span' => 12, 'maxlength' => 50)); ?>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'company_name', array('span' => 12, 'maxlength' => 100)); ?>
        </div>
        <div class="span5">
            <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 12, 'maxlength' => 50)); ?>
            <div class="review-notice">Your name and email are required for verification. We do not publish your last name or your email address in reviews.</div>
        </div>
    </div>

    <?php
    echo TbHtml::submitButton('SUBMIT YOUR REVIEW', array(
        'color' => TbHtml::BUTTON_COLOR_INFO,
        'size' => TbHtml::BUTTON_SIZE_LARGE,
    ));
    ?>
    <div class="row-fluid" style="line-height: 18px;">        
        <?php echo $form->checkBoxControlGroup($model, 'iagree'); ?>
    </div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->