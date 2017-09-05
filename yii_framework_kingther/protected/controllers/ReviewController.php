<?php

class ReviewController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'confirm'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($listing_url_name) {
        $listing = Listing::model()->find('url_name=?', array($listing_url_name));
        if ($listing === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        
        $model = new Review;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Review'])) {
            $model->attributes = $_POST['Review'];
            
            $model->listing_id = $listing->listing_id;            
            $model->date_created = date('Y-m-d', time());
            $model->confirmation_key = md5(uniqid());
            $model->status = 'taken';
            if ($model->save()) {
                $mail = new YiiMailer();
                $mail->setView('review_confirm');
                $mail->setData(array(
                    'title' => 'Your ChiroMonkey.com Review',
                    'name' => $model->first_name . ' ' . $model->last_name,
                    'product' => $listing->name,
                    'url_name' => $listing->url_name,
                    'email' => $model->email,
                    'confirmation_key' => $model->confirmation_key,
                    'review' => $model->review,
                        )
                );
                $mail->setLayout('mail');
                $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name);
                $mail->setTo($model->email);
                $mail->setSubject('Your ChiroMonkey.com Review');
                if ($mail->send()) {
                    Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                } else {
                    Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                }
                $this->redirect(array('/chiropractic_software/' . $listing->url_name . '.html'));
            }
        }
        
        $seoData = SeoData::model()->find('model_name=? AND model_id=?', array('Listing', $listing->listing_id));
        
        if ($seoData !== null) {
            $this->pageTitle = $seoData->title;
            $this->metaKeywords = $seoData->keywords;
            $this->metaDescription = $seoData->description;
        }
        
        $this->render('create', array(
            'model' => $model,
            'listing' => $listing,
        ));
    }

    public function actionConfirm($listing_url_name) {
        if(!isset($_GET['email'])) {
            echo '<div class="flash-error">Email is not set.</div>';
            Yii::app()->end();
        }
        
        if(!isset($_GET['confirmation_key'])) {
            echo '<div class="flash-error">Activation key is not set.</div>';
            Yii::app()->end();
        }
        
        if(($review = Review::model()->find('email=? AND confirmation_key=?', array($_GET['email'], $_GET['confirmation_key']))) != null) {
            $review->status = 'confirmed';
            $review->iagree = true;
            if($review->save()) {
                echo '<div class="flash-success">Thanks for your efforts. You confirmed your review successfully.</div>';                
            }
        } else {
            echo '<div class="flash-error">Confirmation failed.</div>';
        }
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Review the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Review::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Review $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'review-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}