<?php

/**
 * This is the model class for table "tbl_feature".
 *
 * The followings are the available columns in table 'tbl_feature':
 * @property integer $feature_id
 * @property string $type
 * @property string $name
 * @property string $display_name
 * @property string $url_name
 * @property integer $show_on_overview
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Listing[] $listings
 */
class Feature extends ManyManyActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_feature';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, name, display_name, url_name, show_on_overview', 'required'),
            array('show_on_overview', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 18),
            array('name, url_name', 'length', 'max' => 50),
            array('display_name', 'length', 'max' => 100),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('feature_id, type, name, display_name, url_name, show_on_overview, description', 'safe', 'on' => 'search'),
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
            'listings' => array(self::MANY_MANY, 'Listing', 'tbl_listing_feature(feature_id, listing_id)', 'order' => 'sort_number ASC'),
            'max_listing_sort_number' => array(self::STAT, 'ListingFeature', 'feature_id', 'select' => 'MAX(sort_number)', 'defaultValue' => 0),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'feature_id' => 'Feature',
            'type' => 'Type',
            'name' => 'Name',
            'display_name' => 'Display Name',
            'url_name' => 'Url Name',
            'show_on_overview' => 'Show On Overview',
            'description' => 'Description',
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

        $criteria->compare('feature_id', $this->feature_id);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('display_name', $this->display_name, true);
        $criteria->compare('url_name', $this->url_name, true);
        $criteria->compare('show_on_overview', $this->show_on_overview);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feature the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeDelete() {
        ListingFeature::model()->deleteAll('feature_id=:feature_id', array(':feature_id' => $this->feature_id));
        return parent::beforeDelete();
    }

}
