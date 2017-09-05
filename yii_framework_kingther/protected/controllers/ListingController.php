<?php

class ListingController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function behaviors() {
        return array(
            'seo' => array('class' => 'ext.seo.components.SeoControllerBehavior'),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($url_name) {
        $model = Listing::model()->find('url_name=?', array($url_name));
        
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        
        $dataProvider = new CArrayDataProvider($model->active_reviews, array(
            'keyField' => 'review_id',
        ));
        
        $seoData = SeoData::model()->find('model_name=? AND model_id=?', array('Listing', $model->listing_id));
        
        if ($seoData !== null) {
            $this->pageTitle = $seoData->title;
            $this->metaKeywords = $seoData->keywords;
            $this->metaDescription = $seoData->description;
        }
        
        $this->render('view', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Listing the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Listing::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Listing $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'listing-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}