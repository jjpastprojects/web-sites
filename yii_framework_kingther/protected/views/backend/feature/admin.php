<?php
/* @var $this FeatureController */
/* @var $model Feature */


$this->breadcrumbs = array(
    'Features' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Feature', 'url' => array('index')),
    array('label' => 'Create Feature', 'url' => array('create')),
);
?>

<h1>Manage Features</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'feature-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'feature_id',
            'filter' => false,
        ),
        'type',
        'name',
        'display_name',
        'url_name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update} {delete} {listings}',
            'buttons' => array (
                'listings' => array (
                    'label' => 'Listings',
                    'icon' => TbHtml::ICON_SEARCH,
                    'url' => 'Yii::app()->createUrl("backend/feature/listings", array("id" => $data->feature_id))',
                ),
            ),
        ),
    ),
));
?>