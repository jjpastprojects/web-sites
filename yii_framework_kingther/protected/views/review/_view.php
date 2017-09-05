<?php
/* @var $this ReviewController */
/* @var $data Review */
?>

<div class="view">

    <div class="row-fluid" >
        <div class="review-heading">
            <div><strong>Title:</strong>&nbsp;<?php echo $data->title; ?></div>
            <span class="review-title">
                <span style="color: #1f8190; font-weight: bold;">Review by</span> <b><?php echo CHtml::encode($data->first_name); ?></b>
                from <b><?php echo CHtml::encode($data->company_name); ?></b>
                | <span style="color: #f59151;"><?php echo CHtml::encode(date("m-d-Y", strtotime($data->date_created))); ?></span>
            </span>
            <span class="pull-right">
                <span style="color: #ef671b; font-weight: bold;">Overall Rating</span>
                <?php
                $this->widget('ext.DzRaty.DzRaty', array(
                    'name' => 'overall_rating' . $data->review_id,
                    'value' => ($data->ease_of_use + $data->features + $data->client_support) / 3,
                    'options' => array(
                        'readOnly' => TRUE,
                        'starOff' => 'chiropractic-softwareOff.png',
                        'starOn' => 'chiropractic-softwareOn.png',
                        'starHalf' => 'chiropractic-softwareHalf.png',
                    ),
                    'htmlOptions' => array(
                        'style' => 'display: inline-block; padding: 0 10px; height: 20px;',
                    ),
                ));
                ?>
            </span>
        </div>
        <div class="span4 pull-right review-rating">
            <div class="row-fluid">
                <div class="span6 text-right">
                    <b><?php echo CHtml::encode($data->getAttributeLabel('ease_of_use')); ?></b>
                </div>
                <div class="span6">
                    <?php
                    $this->widget('ext.DzRaty.DzRaty', array(
                        'name' => 'ease_of_use' . $data->review_id,
                        'value' => $data->ease_of_use,
                        'options' => array(
                            'readOnly' => TRUE,
                            'starOff' => 'chiropractic-softwareOff.png',
                            'starOn' => 'chiropractic-softwareOn.png',
                            'starHalf' => 'chiropractic-softwareHalf.png',
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 text-right">
                    <b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?></b>
                </div>
                <div class="span6">
                    <?php
                    $this->widget('ext.DzRaty.DzRaty', array(
                        'name' => 'features' . $data->review_id,
                        'value' => $data->features,
                        'options' => array(
                            'readOnly' => TRUE,
                            'starOff' => 'chiropractic-softwareOff.png',
                            'starOn' => 'chiropractic-softwareOn.png',
                            'starHalf' => 'chiropractic-softwareHalf.png',
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 text-right">
                    <b><?php echo CHtml::encode($data->getAttributeLabel('client_support')); ?></b>
                </div>
                <div class="span6">
                    <?php
                    $this->widget('ext.DzRaty.DzRaty', array(
                        'name' => 'client_support' . $data->review_id,
                        'value' => $data->client_support,
                        'options' => array(
                            'readOnly' => TRUE,
                            'starOff' => 'chiropractic-softwareOff.png',
                            'starOn' => 'chiropractic-softwareOn.png',
                            'starHalf' => 'chiropractic-softwareHalf.png',
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 text-right">
                    <b><?php echo CHtml::encode($data->getAttributeLabel('overall_value')); ?></b>
                </div>
                <div class="span6">
                    <?php
                    $this->widget('ext.DzRaty.DzRaty', array(
                        'name' => 'overall_value' . $data->review_id,
                        'value' => $data->overall_value,
                        'options' => array(
                            'readOnly' => TRUE,
                            'starOff' => 'chiropractic-softwareOff.png',
                            'starOn' => 'chiropractic-softwareOn.png',
                            'starHalf' => 'chiropractic-softwareHalf.png',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="review-description">
            <?php echo $data->review; ?>
        </div>
    </div>
</div>