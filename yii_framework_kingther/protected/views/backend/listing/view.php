<?php
/* @var $this ListingController */
/* @var $model Listing */
Yii::app()->clientScript->registerScript('listing-form', '
    function dzRatyUpdate() {
        jQuery(".raty-icons").each(function(){
            var $this = jQuery(this), raty_options = {"space":false,"readOnly":false,"click":function(score,event){$("#"+$(this).data("target")).change();},"targetType":"number","targetKeep":true};
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

<?php
$this->breadcrumbs = array(
    'Listings' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Listing', 'url' => array('index')),
    array('label' => 'Create Listing', 'url' => array('create')),
    array('label' => 'Update Listing', 'url' => array('update', 'id' => $model->listing_id)),
    array('label' => 'Delete Listing', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->listing_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Listing', 'url' => array('admin')),
);

$featureArray = array();
foreach ($model->features as $feature) {
    $featureArray[] = $feature->name;
}
$featureNames = implode(', ', $featureArray);
?>

<h1>View Listing #<?php echo $model->listing_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'name',
        'company_name',
        'url',
        'price_plan',
        'price',
        'support_fee',
        array(
            'name' => 'review',
            'value' => $model->review,
        ),
        array(
            'name' => 'features',
            'value' => $featureNames,
        ),
        array(
            'name' => 'description',
            'type' => 'raw',
        ),
    ),
));

$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/backend/review/_view',
    'afterAjaxUpdate' => 'js:function() { dzRatyUpdate();}',
));
?>