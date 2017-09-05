<?php
/* @var $this PriceFilterController */
/* @var $model PriceFilter */
?>

<?php
$this->breadcrumbs=array(
	'Price Filters'=>array('index'),
	$model->name=>array('view','id'=>$model->price_filter_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PriceFilter', 'url'=>array('index')),
	array('label'=>'Create PriceFilter', 'url'=>array('create')),
	array('label'=>'View PriceFilter', 'url'=>array('view', 'id'=>$model->price_filter_id)),
	array('label'=>'Manage PriceFilter', 'url'=>array('admin')),
);
?>

    <h1>Update PriceFilter <?php echo $model->price_filter_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>