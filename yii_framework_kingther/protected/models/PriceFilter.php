<?php

/**
 * This is the model class for table "tbl_price_filter".
 *
 * The followings are the available columns in table 'tbl_price_filter':
 * @property integer $price_filter_id
 * @property string $price_plan
 * @property string $name
 * @property string $url_name
 * @property integer $start_price
 * @property integer $end_price
 * @property string $description
 */
class PriceFilter extends ManyManyActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_price_filter';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('price_plan, name, url_name, start_price, end_price', 'required'),
            array('start_price, end_price', 'numerical', 'integerOnly' => true),
            array('price_plan', 'length', 'max' => 18),
            array('name, url_name', 'length', 'max' => 100),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('price_filter_id, price_plan, name, url_name, start_price, end_price, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'price_filter_id' => 'Price Filter',
            'price_plan' => 'Price Plan',
            'name' => 'Name',
            'url_name' => 'Url Name',
            'start_price' => 'Start Price',
            'end_price' => 'End Price',
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

        $criteria->compare('price_filter_id', $this->price_filter_id);
        $criteria->compare('price_plan', $this->price_plan, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('url_name', $this->url_name, true);
        $criteria->compare('start_price', $this->start_price);
        $criteria->compare('end_price', $this->end_price);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PriceFilter the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
