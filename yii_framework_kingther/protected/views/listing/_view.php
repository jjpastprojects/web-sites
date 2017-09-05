<?php
/* @var $this ListingController */
/* @var $data Listing */
$featureModels = Feature::model()->findAll();
?>

<div class="view">
    <div class="row-fluid">
        <div class="listing-name">
            <?php echo CHtml::link($data->name, array('/chiropractic_software/' . $data->url_name . '.html')); ?>
        </div>
        <div class="listing-review">
            <?php
            echo CHtml::encode(count($data->active_reviews) . ' Reviews');
            $this->widget('ext.DzRaty.DzRaty', array(
                'name' => 'overall_rating' . $data->listing_id,
                'value' => $data->review,
                'options' => array(
                    'readOnly' => TRUE,
                    'starOff' => 'chiropractic-softwareOff.png',
                    'starOn' => 'chiropractic-softwareOn.png',
                    'starHalf' => 'chiropractic-softwareHalf.png',
                ),
                'htmlOptions' => array(
                    'style' => 'display: inline-block; padding: 0 10px;',
                ),
            ));
            ?>
        </div>
        <hr style="background: #23a0b2; height: 2px; margin-top: 20px; margin-bottom: 20px;">
    </div>
    <div class="row-fluid">
        <div class="span8">
            <?php if (!empty($data->url)) { ?>
                <div class="listing-company-name">
                    by <a href="<?php echo CHtml::encode($data->url); ?>"><?php echo CHtml::encode($data->company_name); ?></a>
                </div>
            <?php } ?>
            <div class="listing-description">
                <?php
                $this->widget('ext.XReadMore.XReadMore', array(
                    'model' => $data,
                    'attribute' => 'description',
                    'maxChar' => 750,
                    'linkUrl' => array('/chiropractic_software/' . $data->url_name . '.html'),
                    'linkHtmlOptions' => array('class' => 'read-more')
                ));
                ?>
            </div>
        </div>
        <div class="span4 pull-right listing-overview">
            <div class="listing-overview-title">Product Overview
                <img src="images/pin.png" class="pin" />
            </div>
            <table class="table-condensed">
                <tr>
                    <td class="text-right listing-attribute-name"><?php echo CHtml::encode($data->getAttributeLabel('price')); ?></td>
                    <td class="listing-attribute-value"><?php echo CHtml::encode($data->price); echo $data->price_plan == 'subscription_price' ? '/month' : ''; ?></td>
                </tr>
                <tr>
                    <td class="text-right listing-attribute-name"><?php echo CHtml::encode($data->getAttributeLabel('support_fee')); ?></td>
                    <td class="listing-attribute-value"><?php echo CHtml::encode($data->support_fee); ?></td>
                </tr>
                <?php
                foreach ($featureModels as $featureModel) {
                    if ($featureModel->show_on_overview) {
                        ?>
                        <tr>
                            <td class="text-right listing-attribute-name"><?php echo $featureModel->name; ?></td>
                            <td class="listing-attribute-value">
                                <?php
                                $hasFeature = false;
                                foreach ($data->features as $feature) {
                                    if ($feature->name == $featureModel->name) {
                                        $hasFeature = true;
                                        break;
                                    }
                                }
                                echo $hasFeature == true ? 'Yes' : 'No';
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>