<h1 class="feature-name">
    <?php echo $model->display_name; ?>
</h1>

<div class="feature-descriptin">
    <?php echo $model->description; ?>
</div>
<?php
Yii::app()->clientScript->registerScript('listing-form', '
    function dzRatyUpdate() {
        jQuery(".raty-icons").each(function(){
            var $this = jQuery(this), raty_options = {"space":false,"readOnly":true,"starOff":"chiropractic-softwareOff.png","starOn":"chiropractic-softwareOn.png","starHalf":"chiropractic-softwareHalf.png","click":function(score,event){$("#"+$(this).data("target")).change();},"targetType":"number","targetKeep":true};
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
<?php if ($dataProvider->itemCount > 0) { ?>
    <h2>Chiropractic Software Reviews</h2>
<?php } ?>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/listing/_view',
    'emptyText' => '',
    'afterAjaxUpdate' => 'js:function() { dzRatyUpdate(); window.scrollTo(0, 0); }',
));
?>