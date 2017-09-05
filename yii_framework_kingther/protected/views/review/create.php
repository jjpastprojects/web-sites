<?php
/* @var $this ReviewController */
/* @var $model Review */
?>

<h1>Enter A Review for <span style="color: red;"><?php echo $listing->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>