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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete','listingReposition','ajaxupdate'),
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
        $model = $this->loadModel($id);
        $dataProvider = new CArrayDataProvider($model->reviews, array(
            'keyField' => 'review_id',
        ));
        $this->render('view', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Listing;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            $features = $_POST['Listing']['features'];
            if ($model->save()) {

				$model_temp = new Listing;
				$criteria=new CDbCriteria;
				$criteria->select='max(sorting_number) AS maxColumn';
				$row_temp = $model_temp->model()->find($criteria);
				$max = $row_temp['maxColumn'];
				$model->sorting_number = $max+1;
				$model->save();
                $model->addRelationRecords('features', $features);
                $this->redirect(array('view', 'id' => $model->listing_id));
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

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            $features = isset($_POST['Listing']['features']) ? $_POST['Listing']['features'] : array();
            if ($model->save()) {
                $additionalFieldsArray = array();
                foreach ($features as $feature) {
                    $additionalFields = array();
                    $list_feature_model = ListingFeature::model()->find('feature_id=:feature_id AND listing_id=:listing_id', array(':feature_id' => $feature, ':listing_id' => $model->listing_id));
                    if ($list_feature_model != null) {
                        $additionalFields['sort_number'] = $list_feature_model->sort_number;
                    } else {
                        $additionalFields['sort_number'] = Feature::model()->with('max_listing_sort_number')->findByPk($feature)->max_listing_sort_number + 1;
                    }
                    $additionalFieldsArray[] = $additionalFields;
                }
                $model->setRelationRecords('features', $features, $additionalFieldsArray);
                $this->redirect(array('view', 'id' => $model->listing_id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $reviews = Review::model()->findAllByAttributes(array(
                'listing_id' => $id,
            ));
            foreach ($reviews as $review) {
                $review->delete();
            }
            
            $listingFeatures = ListingFeature::model()->findAllByAttributes(array(
                'listing_id' => $id,
            ));
            foreach($listingFeatures as $listingFeature) {
                $listingFeature->delete();
            }
            
            $seoRecords = SeoData::model()->findAllByAttributes(array(
                'model_name' => 'Listing',
                'model_id' => $id,
            ));
            
            foreach($seoRecords as $seoRecord) {
                $seoRecord->delete();
            }
            
            // we only allow deletion via POST request
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
		
        $dataProvider = new CActiveDataProvider('Listing');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Listing('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Listing'])) {
            $model->attributes = $_GET['Listing'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

	public function actionAjaxupdate(){
		//print_r($_POST);exit;
		$sortOrderAll = $_POST['sorting_number'];
		if(count($sortOrderAll)>0)
		{
			foreach($sortOrderAll as $listing_id => $sortOrder)
			{
				$model = $this->loadModel($listing_id);
				$model->sorting_number = $sortOrder;
				$model->save();
			}
		}
		//$this->redirect('/backend/listing/admin');
	}

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Listing the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Listing::model()->with('features', 'reviews')->findByPk($id);
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

	
    public function actionListingReposition1() {
        $models = Listing::model()->findAll(array('order' => 'sorting_number'));
        if (isset($_GET['listing_id']) && isset($_GET['direction'])) {
            $listing_id = $_GET['listing_id'];
            $direction = $_GET['direction'];
            
            $listings = array();
            if ($direction == 'up') {
                $listings = $models;
            } else if ($direction == 'down') {
                $listings = array_reverse($models);
            }
            
            foreach($listings as $listing) {
                if ($listing->listing_id == $listing_id) {
                    if (isset($prevListing)) {
                        $sort_number = $listing->sorting_number;
                        $listing->sorting_number = $prevListing->sorting_number;
                        $prevListing->sorting_number = $sort_number;
                        $listing->save();
                        $prevListing->save();
                    }
                }
                $prevListing = $listing;
            }
        }
    }



	public function actionListingReposition()
{
          if(isset($_GET['direction']) && isset($_GET['sortOrder']) && isset($_GET['listing_id']) )
          {
            $direction=$_GET['direction'];
            $sortOrder=(int)$_GET['sortOrder'];
            $id = $_GET['listing_id'];
                        
			if ($direction=='up') {
				$newSortOrder = $sortOrder-1;
			} else if ($direction=='down') {
				$newSortOrder = $sortOrder+1;
			} 

			$connection=Yii::app()->db;

			$sql='SELECT listing_id from tbl_listing WHERE sorting_number = "' . $newSortOrder . '"';
			$command=$connection->createCommand($sql);
			$reader=$command->query();
			foreach($reader as $row) {
				$otherId = $row["listing_id"];
			}
			$sql='UPDATE tbl_listing SET sorting_number = "' . $newSortOrder . '" WHERE listing_id = "' . $id . '"';
			$command=$connection->createCommand($sql);
			$command->execute();
			if ($reader->getRowCount() > 0) {
				$sql='UPDATE tbl_listing SET sorting_number = "' . $sortOrder . '" WHERE listing_id = "' . $otherId . '"';
				$command=$connection->createCommand($sql);
				$command->execute();
			}
         }
}


}


