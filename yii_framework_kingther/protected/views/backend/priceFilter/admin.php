<?php
/* @var $this PriceFilterController */
/* @var $model PriceFilter */


$this->breadcrumbs = array(
    'Price Filters' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List PriceFilter', 'url' => array('index')),
    array('label' => 'Create PriceFilter', 'url' => array('create')),
);
?>

<h1>Manage Price Filters</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'price-filter-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'price_plan',
        'name',
        'url_name',
        'start_price',
        'end_price',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>