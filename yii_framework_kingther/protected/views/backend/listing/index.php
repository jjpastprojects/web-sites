<?php
/* @var $this ListingController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('listing-form', '
    function dzRatyUpdate() {
        jQuery(".raty-icons").each(function(){
            var $this = jQuery(this), raty_options = {"space":false,"readOnly":false,"click":function(score,event){$("#"+$(this).data("target")).change();},"targetType":"number","targetKeep":true};
            raty_options.target = "#"+$this.data("target");
            var $target = jQuery(raty_options.target);
            raty_options.score = $target.val();
            $this.raty(raty_options);
            console.log(raty_options);
            $target.hide();
        });
    }
');
?>

<?php
$this->breadcrumbs = array(
    'Listings',
);

$this->menu = array(
    array('label' => 'Create Listing', 'url' => array('create')),
    array('label' => 'Manage Listing', 'url' => array('admin')),
);
?>

<h1>Listings</h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'afterAjaxUpdate' => 'js:function() { dzRatyUpdate();}',
));
?>