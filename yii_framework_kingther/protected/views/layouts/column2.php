<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="body">
    <div class="row-fluid">
        <div class="span3">
            <div id="sidebar">
                <?php
                $featureModels = Feature::model()->findAll();

                preg_match('/([a-z0-9_]*).html/', Yii::app()->request->url, $matches);
                $currentPage = '';
                if (count($matches) != 0) {
                    $currentPage = $matches[1];
                }
                $categoryMenuItems = array();
                $fixPriceMenuItems = array();
                $subscriptionPriceMenuItems = array();

                foreach ($featureModels as $featureModel) {
                    //$featureMenuItems[] = array('label' => $featureModel->name, 'url' => array('/feature/view', 'id' => $featureModel->feature_id));
                    if ($featureModel->url_name == $currentPage) {
                        $featureMenuItem = array('label' => '&rarr;&nbsp;&nbsp;' . $featureModel->name, 'url' => array('/' . $featureModel->url_name . '.html'), 'active' => true);
                    } else {
                        $featureMenuItem = array('label' => '&rarr;&nbsp;&nbsp;' . $featureModel->name, 'url' => array('/' . $featureModel->url_name . '.html'), 'active' => false);
                    }

                    switch ($featureModel->type) {
                        case 'category':
                            $categoryMenuItems[] = $featureMenuItem;
                            break;
                        case 'fixed_price':
                            $fixPriceMenuItems[] = $featureMenuItem;
                            break;
                        case 'subscription_price':
                            $subscriptionPriceMenuItems[] = $featureMenuItem;
                            break;
                    }
                }

                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title' => 'SOFTWARE FEATURES',
                ));

                $this->widget('zii.widgets.CMenu', array(
                    'items' => $categoryMenuItems,
                    'encodeLabel' => false,
                ));
                $this->endWidget();
                
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title' => 'SUBSCRIPTION-BASED PRICING',
                ));

                $this->widget('zii.widgets.CMenu', array(
                    'items' => $subscriptionPriceMenuItems,
                    'encodeLabel' => false,
                ));
                $this->endWidget();

                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title' => 'FIXED PRICING',
                ));

                $this->widget('zii.widgets.CMenu', array(
                    'items' => $fixPriceMenuItems,
                    'encodeLabel' => false,
                ));
                $this->endWidget();

                $this->beginWidget('zii.widgets.CPortlet');

                echo TbHtml::link(TbHtml::image(Yii::app()->request->baseUrl . '/images/sponsor-ad-cf1.jpg', 'ad'), 'http://www.mychirofusion.com');

                $this->endWidget();
                ?>
            </div><!-- sidebar -->
        </div>

        <div class="span9 last">
            <gcse:searchresults></gcse:searchresults>
            <div id="content">                
                <?php echo $content; ?>
            </div><!-- content -->
        </div>
    </div>
</div>
<?php $this->endContent(); ?>