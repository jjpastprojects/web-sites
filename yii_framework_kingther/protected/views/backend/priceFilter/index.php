<?php
/* @var $this PriceFilterController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Price Filters',
);

$this->menu=array(
	array('label'=>'Create PriceFilter','url'=>array('create')),
	array('label'=>'Manage PriceFilter','url'=>array('admin')),
);
?>

<h1>Price Filters</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>