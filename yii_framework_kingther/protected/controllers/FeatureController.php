<?php

class FeatureController extends Controller {

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
        );
    }

    public function behaviors() {
        return array(
            'seo' => array('class' => 'ext.seo.components.SeoControllerBehavior'),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($url_name) {

        $model = Feature::model()->with(array('listings'=>array('order' =>'sorting_number ASC')))->find('t.url_name=?', array($url_name));

        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $seoData = SeoData::model()->find('model_name=? AND model_id=?', array('Feature', $model->feature_id));
        
        if ($seoData !== null) {
            $this->pageTitle = $seoData->title;
            $this->metaKeywords = $seoData->keywords;
            $this->metaDescription = $seoData->description;
        }

		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.sorting_number DESC'
		);
        //echo '<pre>';
		//print_r($model->listings);
		//echo '<.pre>';exit;
        $dataProvider = new CArrayDataProvider($model->listings, array(
            'keyField' => 'listing_id',
            'pagination' => array('pageSize' => 50),
			'sort'=>$sort
        ));

        $this->render('view', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Feature the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Feature::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}