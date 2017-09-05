<?php
/* @var $this PageController */
/* @var $model Page */


$this->breadcrumbs = array(
    'Pages' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Page', 'url' => array('index')),
    array('label' => 'Create Page', 'url' => array('create')),
);
?>

<h1>Manage Pages</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'page_id',
            'filter' => false,
        ),        
        'title',
        'url_name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>