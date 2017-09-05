<?php
/* @var $this ListingController */
/* @var $model Listing */


$this->breadcrumbs = array(
    'Listings' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Listing', 'url' => array('index')),
    array('label' => 'Create Listing', 'url' => array('create')),
);
?>

<h1>Manage Listings</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'listing-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'listing_id',
            'filter' => false,
        ),
        'name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{up} {down}',
            'buttons' => array(
                'up' => array(
                    'label' => 'Sort Up',
                    'icon' => TbHtml::ICON_ARROW_UP,
                    'url' => 'Yii::app()->createUrl("backend/feature/listingReposition", array("id" => ' . $feature_id . ', "listing_id" => $data->listing_id, "direction" => "up"))',
                    'click' => "function(){
                        $.fn.yiiGridView.update('listing-grid', {
                            type:'GET',
                            url:$(this).attr('href'),
                            success:function(data) {
                                $.fn.yiiGridView.update('listing-grid');
                            }
                        })
                        return false;
                    }",
                ),
                'down' => array(
                    'label' => 'Sort Down',
                    'icon' => TbHtml::ICON_ARROW_DOWN,
                    'url' => 'Yii::app()->createUrl("backend/feature/listingReposition", array("id" => ' . $feature_id . ', "listing_id" => $data->listing_id, "direction" => "down"))',
                    'click' => "function(){
                        $.fn.yiiGridView.update('listing-grid', {
                            type:'GET',
                            url:$(this).attr('href'),
                            success:function(data) {
                                $.fn.yiiGridView.update('listing-grid');
                            }
                        })
                        return false;
                    }",
                )
            ),
        ),
    ),
));
?>