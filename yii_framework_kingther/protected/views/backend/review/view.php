<?php
/* @var $this ReviewController */
/* @var $model Review */
?>

<?php
$this->breadcrumbs = array(
    'Reviews' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Review', 'url' => array('index')),
    array('label' => 'Create Review', 'url' => array('create')),
    array('label' => 'Update Review', 'url' => array('update', 'id' => $model->review_id)),
    array('label' => 'Delete Review', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->review_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Review', 'url' => array('admin')),
);
?>

<h1>View Review #<?php echo $model->review_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'listing_id',
            'value' => $model->listing->name,
        ),
        'ease_of_use',
        'features',
        'client_support',
        'overall_value',
        'title',
        'review',
        'first_name',
        'last_name',
        'company_name',
        'email',
    ),
));
?>