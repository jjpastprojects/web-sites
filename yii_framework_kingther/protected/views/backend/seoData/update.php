<?php
/* @var $this SeoDataController */
/* @var $model SeoData */
?>

<?php
$this->breadcrumbs=array(
	'Seo Datas'=>array('index'),
	$model->title=>array('view','id'=>$model->seo_data_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SeoData', 'url'=>array('index')),
	array('label'=>'Create SeoData', 'url'=>array('create')),
	array('label'=>'View SeoData', 'url'=>array('view', 'id'=>$model->seo_data_id)),
	array('label'=>'Manage SeoData', 'url'=>array('admin')),
);
?>

    <h1>Update SeoData <?php echo $model->seo_data_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>