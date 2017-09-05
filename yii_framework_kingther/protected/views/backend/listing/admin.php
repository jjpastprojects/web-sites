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
$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>true,'action'=>Yii::app()->createUrl('backend/listing/ajaxupdate'),)); 

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'listing-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate' => 'js:function() { dzRatyUpdate(); }',
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'listing_id',
            'filter' => false,
        ),        
        'name',
        'price_plan',
        'price',
        array(
            'name' => 'review',
            'class' => 'ext.DzRaty.DzRatyDataColumn', // #2 - Add a jQuery Raty data column
            'options' => array(// Custom options for jQuery Raty data column
                'space' => FALSE
            ), 'filter' => false
        ),
		array(
            'name' => 'total_reviews',
             'filter' => false,
			 'value'  => '($data->total_reviews > 0) ? "( $data->total_reviews )" : "( $data->total_reviews )"',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
		array(
            'name'=>'sorting_number',
            'type'=>'raw',
            'value'=>'CHtml::textField("sorting_number[$data->listing_id]",$data->sorting_number,array("style"=>"width:50%;"))'
		)
		/*array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{up} {down}',
            'buttons' => array(
                'up' => array(
                    'label' => 'Sort Up',
                    'icon' => TbHtml::ICON_ARROW_UP,
                    'url' => 'Yii::app()->createUrl("backend/listing/listingReposition", array("listing_id" => $data->listing_id, "sortOrder" => $data->sorting_number, "direction" => "up"))',
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
                    'url' => 'Yii::app()->createUrl("backend/listing/listingReposition", array("listing_id" => $data->listing_id, "sortOrder" => $data->sorting_number, "direction" => "down"))',
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
        ),*/
    ),
));
echo '<div style="float:right;margin:0px 10px 15px 15px;">';
echo CHtml::ajaxSubmitButton('Update Order',array('backend/listing/ajaxupdate','act'=>'doSortOrder'), array('success'=>'reloadGrid'));
echo '</div>';
$this->endWidget();

?>
<style>
.table th, .table td{
	text-align: center !important;
}
</style>
<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('listing-grid');
}
</script>