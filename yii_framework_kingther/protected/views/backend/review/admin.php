<?php
/* @var $this ReviewController */
/* @var $model Review */


$this->breadcrumbs = array(
    'Reviews' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Review', 'url' => array('index')),
    array('label' => 'Create Review', 'url' => array('create')),
);
?>

<h1>Manage Reviews</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'review-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate' => 'js:function() { dzRatyUpdate(); }',
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'review_id',
            'filter' => false,
        ),
        array(
            'name' => 'listing_id',
            'value' => '$data->listing->name',
        ),
        'title',
        array(
            'name' => 'ease_of_use',
            'class' => 'ext.DzRaty.DzRatyDataColumn', // #2 - Add a jQuery Raty data column
            'options' => array(// Custom options for jQuery Raty data column
                'space' => FALSE
            ), 'filter' => false
        ),
        array(
            'name' => 'features',
            'class' => 'ext.DzRaty.DzRatyDataColumn', // #2 - Add a jQuery Raty data column
            'options' => array(// Custom options for jQuery Raty data column
                'space' => FALSE
            ), 'filter' => false
        ),
        array(
            'name' => 'client_support',
            'class' => 'ext.DzRaty.DzRatyDataColumn', // #2 - Add a jQuery Raty data column
            'options' => array(// Custom options for jQuery Raty data column
                'space' => FALSE
            ), 'filter' => false
        ),
        array(
            'name' => 'overall_value',
            'class' => 'ext.DzRaty.DzRatyDataColumn', // #2 - Add a jQuery Raty data column
            'options' => array(// Custom options for jQuery Raty data column
                'space' => FALSE
            ), 'filter' => false
        ),
        'date_created',
        'status',
        /*
          'review',
          'first_name',
          'last_name',
          'company_name',
          'email',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>