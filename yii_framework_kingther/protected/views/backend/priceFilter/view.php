<?php
/* @var $this PriceFilterController */
/* @var $model PriceFilter */
?>

<?php
$this->breadcrumbs = array(
    'Price Filters' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List PriceFilter', 'url' => array('index')),
    array('label' => 'Create PriceFilter', 'url' => array('create')),
    array('label' => 'Update PriceFilter', 'url' => array('update', 'id' => $model->price_filter_id)),
    array('label' => 'Delete PriceFilter', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->price_filter_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage PriceFilter', 'url' => array('admin')),
);
?>

<h1>View PriceFilter #<?php echo $model->price_filter_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
        'price_filter_id',
        'price_plan',
        'name',
        'url_name',
        'start_price',
        'end_price',
        'description',
    ),
));
?>