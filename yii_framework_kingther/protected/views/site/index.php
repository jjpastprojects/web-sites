<?php

/* @var $this SiteController */
$page = Page::model()->find('url_name=?', array('home'));

$this->pageTitle = Yii::app()->name . ' ' . $page->title;

$this->renderPartial('//page/view', array('model' => $page));
?>