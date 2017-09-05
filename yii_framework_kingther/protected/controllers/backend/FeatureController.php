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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'listings', 'listingReposition'),
                'users' => array('@'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Feature;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Feature'])) {
            $model->attributes = $_POST['Feature'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->feature_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Feature'])) {
            $model->attributes = $_POST['Feature'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->feature_id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionListings($id) {
        $model = Feature::model()->with('listings')->findByPk($id);
        $dataProvider = new CArrayDataProvider($model->listings, array(
            'keyField' => 'listing_id',
        ));

        $this->render('listings', array(
            'feature_id' => $id,
            'dataProvider' => $dataProvider
        ));
    }

    public function actionListingReposition($id) {
        $models = ListingFeature::model()->findAll(array('order' => 'sort_number', 'condition' => 'feature_id=:feature_id', 'params' => array(':feature_id' => $id)));
        if (isset($_GET['listing_id']) && isset($_GET['direction'])) {
            $listing_id = $_GET['listing_id'];
            $direction = $_GET['direction'];
            
            $listingFeatures = array();
            if ($direction == 'up') {
                $listingFeatures = $models;
            } else if ($direction == 'down') {
                $listingFeatures = array_reverse($models);
            }
            
            foreach($listingFeatures as $listingFeature) {
                if ($listingFeature->listing_id == $listing_id) {
                    if (isset($prevListingFeature)) {
                        $sort_number = $listingFeature->sort_number;
                        $listingFeature->sort_number = $prevListingFeature->sort_number;
                        $prevListingFeature->sort_number = $sort_number;
                        $listingFeature->save();
                        $prevListingFeature->save();
                    }
                }
                $prevListingFeature = $listingFeature;
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            
            $listingFeatures = ListingFeature::model()->findAllByAttributes(array(
                'feature_id' => $id,
            ));
            foreach($listingFeatures as $listingFeature) {
                $listingFeature->delete();
            }
            
            $seoRecords = SeoData::model()->findAllByAttributes(array(
                'model_name' => 'Feature',
                'model_id' => $id,
            ));
            
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Feature');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Feature('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Feature'])) {
            $model->attributes = $_GET['Feature'];
        }

        $this->render('admin', array(
            'model' => $model,
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

    /**
     * Performs the AJAX validation.
     * @param Feature $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'feature-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}