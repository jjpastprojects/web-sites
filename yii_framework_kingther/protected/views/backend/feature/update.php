<?php
/* @var $this FeatureController */
/* @var $model Feature */
?>

<?php
$this->breadcrumbs=array(
	'Features'=>array('index'),
	$model->name=>array('view','id'=>$model->feature_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Feature', 'url'=>array('index')),
	array('label'=>'Create Feature', 'url'=>array('create')),
	array('label'=>'View Feature', 'url'=>array('view', 'id'=>$model->feature_id)),
	array('label'=>'Manage Feature', 'url'=>array('admin')),
);
?>

    <h1>Update Feature <?php echo $model->feature_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>