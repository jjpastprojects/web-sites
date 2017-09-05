<?php

/**
 * This is the model class for table "tbl_seo_data".
 *
 * The followings are the available columns in table 'tbl_seo_data':
 * @property integer $seo_data_id
 * @property string $model_name
 * @property integer $model_id
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class SeoData extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_seo_data';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('model_name, model_id', 'required'),
            array('model_id', 'numerical', 'integerOnly' => true),
            array('model_name', 'length', 'max' => 50),
            array('model_id', 'unique', 'criteria' => array(
                    'condition' => '`model_name`=:model_name',
                    'params' => array(
                        ':model_name' => $this->model_name
                    )
                )),
            array('title, keywords, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('seo_data_id, model_name, model_id, title, keywords, description', 'safe', 'on' => 'search'),
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
            'seo_data_id' => 'Seo Data',
            'model_name' => 'Model Name',
            'model_id' => 'Model',
            'title' => 'Title',
            'keywords' => 'Keywords',
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

        $criteria->compare('seo_data_id', $this->seo_data_id);
        $criteria->compare('model_name', $this->model_name, true);
        $criteria->compare('model_id', $this->model_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SeoData the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getModel() {
        switch ($this->model_name) {
            case 'Page':
                $model = Page::model()->findByPk($this->model_id)->title;
                break;
            case 'Feature':
                $model = Feature::model()->findByPk($this->model_id)->name;
                break;
            case 'Listing':
                $model = Listing::model()->findByPk($this->model_id)->name;
                break;
        }
        return $model;
    }

}
