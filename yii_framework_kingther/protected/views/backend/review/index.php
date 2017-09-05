<?php
/* @var $this ReviewController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
    'Reviews',
);

$this->menu = array(
    array('label' => 'Create Review', 'url' => array('create')),
    array('label' => 'Manage Review', 'url' => array('admin')),
);
?>

<h1>Reviews</h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>