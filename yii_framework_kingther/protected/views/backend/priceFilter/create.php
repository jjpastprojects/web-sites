<?php
/* @var $this PriceFilterController */
/* @var $model PriceFilter */
?>

<?php
$this->breadcrumbs=array(
	'Price Filters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PriceFilter', 'url'=>array('index')),
	array('label'=>'Manage PriceFilter', 'url'=>array('admin')),
);
?>

<h1>Create PriceFilter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>