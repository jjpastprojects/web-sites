<?php
/* @var $this SeoDataController */
/* @var $model SeoData */
?>

<?php
$this->breadcrumbs=array(
	'Seo Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SeoData', 'url'=>array('index')),
	array('label'=>'Manage SeoData', 'url'=>array('admin')),
);
?>

<h1>Create SeoData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>