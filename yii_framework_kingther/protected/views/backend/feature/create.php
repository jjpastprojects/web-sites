<?php
/* @var $this FeatureController */
/* @var $model Feature */
?>

<?php
$this->breadcrumbs = array(
    'Features' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Feature', 'url' => array('index')),
    array('label' => 'Manage Feature', 'url' => array('admin')),
);
?>

<h1>Create Feature</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>