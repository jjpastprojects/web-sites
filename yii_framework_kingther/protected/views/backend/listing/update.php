<?php
/* @var $this ListingController */
/* @var $model Listing */
?>

<?php
$this->breadcrumbs=array(
	'Listings'=>array('index'),
	$model->name=>array('view','id'=>$model->listing_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Listing', 'url'=>array('index')),
	array('label'=>'Create Listing', 'url'=>array('create')),
	array('label'=>'View Listing', 'url'=>array('view', 'id'=>$model->listing_id)),
	array('label'=>'Manage Listing', 'url'=>array('admin')),
);
?>

    <h1>Update Listing <?php echo $model->listing_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>