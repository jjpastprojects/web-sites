<?php
/* @var $this FeatureController */
/* @var $model Feature */
?>

<?php
$this->breadcrumbs = array(
    'Features' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Feature', 'url' => array('index')),
    array('label' => 'Create Feature', 'url' => array('create')),
    array('label' => 'Update Feature', 'url' => array('update', 'id' => $model->feature_id)),
    array('label' => 'Delete Feature', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->feature_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Feature', 'url' => array('admin')),
);
?>

<h1>View Feature #<?php echo $model->feature_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'name',
        'type',
        'display_name',
        'url_name',
        array(
            'name' => 'description',
            'type' => 'raw',
        ),        
    ),
));
?>