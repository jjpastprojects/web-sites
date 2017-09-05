<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Admin Panel</h1>
<div class="row-fluid" style="text-align: center;">
    <ul class="quick-actions">
        <li>
            <a href="/backend/page/admin">
                <i class="icon-page"></i>
                Manage Pages
            </a>
        </li>
        <li>
            <a href="/backend/feature/admin">
                <i class="icon-feature"></i>
                Manage Features
            </a>
        </li>
        <li>
            <a href="/backend/listing/admin">
                <i class="icon-listing"></i>
                Manage Listings
            </a>
        </li>
        <li>
            <a href="/backend/review/admin">
                <i class="icon-review"></i>
                Manage Reviews
            </a>
        </li>
        <li>
            <a href="/backend/seoData/admin">
                <i class="icon-seo"></i>
                Manage SEO Data
            </a>
        </li>
    </ul>
</div>