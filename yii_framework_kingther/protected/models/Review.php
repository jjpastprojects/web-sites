<?php

/**
 * This is the model class for table "tbl_review".
 *
 * The followings are the available columns in table 'tbl_review':
 * @property integer $review_id
 * @property integer $listing_id
 * @property integer $ease_of_use
 * @property integer $features
 * @property integer $client_support
 * @property integer $overall_value
 * @property string $title
 * @property string $review
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $email
 * @property string $date_created
 * @property string $confirmation_key
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Listing $listing
 */
class Review extends CActiveRecord {

    public $iagree;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('listing_id, ease_of_use, features, client_support, overall_value, title, review, first_name, last_name, company_name, email, date_created, confirmation_key, status', 'required'),
            array('listing_id, ease_of_use, features, client_support, overall_value', 'numerical', 'integerOnly' => true),
            array('title, company_name', 'length', 'max' => 100),
            array('first_name, last_name, email', 'length', 'max' => 50),
            array('confirmation_key', 'length', 'max' => 54),
            array('status', 'length', 'max' => 9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('review_id, listing_id, ease_of_use, features, client_support, overall_value, title, review, first_name, last_name, company_name, email, date_created, confirmation_key, status', 'safe', 'on' => 'search'),
            array('iagree', 'compare', 'compareValue' => true, 'message' => 'You must agree to the terms and conditions' ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'listing' => array(self::BELONGS_TO, 'Listing', 'listing_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'review_id' => 'Review',
            'listing_id' => 'Listing',
            'ease_of_use' => 'Ease Of Use',
            'features' => 'Features',
            'client_support' => 'Client Support',
            'overall_value' => 'Overall Value',
            'title' => 'Title',
            'review' => 'Review',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'company_name' => 'Company Name',
            'email' => 'Email',
            'date_created' => 'Date Created',
            'confirmation_key' => 'Confirmation Key',
            'status' => 'Status',
            'iagree' => 'I agree with the Terms Of Use',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('review_id', $this->review_id);
        $criteria->compare('listing_id', $this->listing_id);
        $criteria->compare('ease_of_use', $this->ease_of_use);
        $criteria->compare('features', $this->features);
        $criteria->compare('client_support', $this->client_support);
        $criteria->compare('overall_value', $this->overall_value);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('review', $this->review, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('confirmation_key', $this->confirmation_key, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
