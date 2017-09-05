<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->page_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->page_id)),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

    <h1>Update Page <?php echo $model->page_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>