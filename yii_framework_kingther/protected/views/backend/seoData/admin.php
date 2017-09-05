<?php
/* @var $this SeoDataController */
/* @var $model SeoData */


$this->breadcrumbs = array(
    'Seo Datas' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List SeoData', 'url' => array('index')),
    array('label' => 'Create SeoData', 'url' => array('create')),
);

?>

<h1>Manage Seo Datas</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'seo-data-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'seo_data_id',
            'filter' => FALSE,
        ),
        'model_name',
        array(
            'name' => 'model_id',
            'value' => '$data->getModel()',
        ),        
        'title',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>