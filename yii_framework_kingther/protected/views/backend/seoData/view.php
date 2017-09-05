<?php
/* @var $this SeoDataController */
/* @var $model SeoData */
?>

<?php
$this->breadcrumbs=array(
	'Seo Datas'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SeoData', 'url'=>array('index')),
	array('label'=>'Create SeoData', 'url'=>array('create')),
	array('label'=>'Update SeoData', 'url'=>array('update', 'id'=>$model->seo_data_id)),
	array('label'=>'Delete SeoData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->seo_data_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SeoData', 'url'=>array('admin')),
);
?>

<h1>View SeoData #<?php echo $model->seo_data_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'seo_data_id',
		'model_name',
		'model_id',
		'title',
		'keywords',
		'description',
	),
)); ?>