<?php

/**
 * This is the model class for table "tbl_listing".
 *
 * The followings are the available columns in table 'tbl_listing':
 * @property integer $listing_id
 * @property string $name
 * @property string $url_name
 * @property string $company_name
 * @property string $url
 * @property integer $price
 * @property string $price_plan
 * @property integer $support_fee
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Feature[] $features
 * @property Review[] $reviews
 */
class Listing extends ManyManyActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_listing';
    }
	public $maxColumn;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, url_name, price', 'required'),
            array('name, url_name, company_name', 'length', 'max' => 100),
            array('price, support_fee', 'length', 'max'=>50),
            array('url', 'length', 'max' => 250),
            array('price_plan', 'length', 'max' => 18),
            array('description', 'safe'),
			array('sorting_number', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('listing_id, name, url_name, company_name, url, price, price_plan, support_fee, description,sorting_number', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        return array(
            'sitemap' => array('select' => 'url_name'),
        );
    }
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'features' => array(self::MANY_MANY, 'Feature', 'tbl_listing_feature(listing_id, feature_id)'),
            'review' => array(self::STAT, 'Review', 'listing_id', 
                'select' => '(SUM(ease_of_use + features + client_support + overall_value) / COUNT(*) / 4)',
                'condition' => 'status = "approved"'),
			'total_reviews' => array(self::STAT, 'Review', 'listing_id', 
                'select' => '(COUNT(*))',
                'condition' => 'status = "approved"'),
            'reviews' => array(self::HAS_MANY, 'Review', 'listing_id', 'order' => 'date_created DESC'),
            'active_reviews' => array(self::HAS_MANY, 'Review', 'listing_id', 'condition' => 'status = "approved"', 'order'=>'date_created DESC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'listing_id' => 'Listing',
            'name' => 'Product Name',
            'url_name' => 'Url Name',
            'company_name' => 'Company Name',
            'url' => 'Url',
            'price' => 'Price',
            'price_plan' => 'Price Plan',
            'support_fee' => 'Support Fee',
            'description' => 'Description',
			'sorting_number' => 'Sort Number',
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

		$criteria->order = 'sorting_number ASC';

        $criteria->compare('listing_id', $this->listing_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('url_name', $this->url_name, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('price_plan', $this->price_plan, true);
        $criteria->compare('support_fee', $this->support_fee);
        $criteria->compare('description', $this->description, true);
		$criteria->compare('sorting_number', $this->sorting_number,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Listing the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeDelete() {
        ListingFeature::model()->deleteAll('listing_id=:listing_id', array(':listing_id' => $this->listing_id));
        return parent::beforeDelete();
    }

}
