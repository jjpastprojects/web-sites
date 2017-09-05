<?php
/* @var $this ListingController */
/* @var $model Listing */
$featureModels = Feature::model()->findAll();
Yii::app()->clientScript->registerScript('listing-form', '
    function dzRatyUpdate() {
        jQuery(".raty-icons").each(function(){
            var $this = jQuery(this), raty_options = {"space":false,"readOnly":false,"starOff":"chiropractic-softwareOff.png","starOn":"chiropractic-softwareOn.png","starHalf":"chiropractic-softwareHalf.png","click":function(score,event){$("#"+$(this).data("target")).change();},"targetType":"number","targetKeep":true};
            raty_options.target = "#"+$this.data("target");
            var $target = jQuery(raty_options.target);
            raty_options.score = $target.val();
            $this.raty(raty_options);
            console.log(raty_options);
            $target.hide();
        });
    }
');
?>

<div class="row-fluid">
    <div class="listing-name">
        <?php echo CHtml::link($model->name, ''); ?>
    </div>
    <div class="listing-review">
    <?php
    echo CHtml::encode(count($model->active_reviews) . ' Reviews', '#reviews');
    $this->widget('ext.DzRaty.DzRaty', array(
        'model' => $model,
        'attribute' => 'review',
        'options' => array(
            'readOnly' => TRUE,
            'starOff' => 'chiropractic-softwareOff.png',
            'starOn' => 'chiropractic-softwareOn.png',
            'starHalf' => 'chiropractic-softwareHalf.png',
        ),
        'htmlOptions' => array(
            'style' => 'display: inline-block; padding: 0 10px;',
        ),
    ));    
    ?>
    </div>
    <?php if(!empty($data->url)) { ?>
    <div class="listing-company-name">
        by <a href="<?php echo CHtml::encode($model->url); ?>"><?php echo CHtml::encode($model->company_name); ?></a>
    </div>
    <?php } ?>
    <div class="listing-description">
        <?php echo $model->description; ?>
    </div>
    <div class="row-fluid reviews" id="reviews">
        <span class="review-count"><?php echo CHtml::encode(count($model->active_reviews) . ' Reviews', ''); ?></span>
        <?php echo CHtml::link('Write a Review', array('/chiropractic_software/write_a_review/' . $model->url_name . '.html'), array('class' => 'write_a_review')); ?>
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '/review/_view',
            'emptyText' => '',
            'afterAjaxUpdate' => 'js:function() { dzRatyUpdate();}',
        ));
        ?>
    </div>
</div>