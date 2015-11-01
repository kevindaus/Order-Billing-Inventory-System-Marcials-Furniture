<?php

/**
 * This is the model class for table "tbl_materials".
 *
 * The followings are the available columns in table 'tbl_materials':
 * @property integer $id
 * @property string $name
 * @property string $sku
 * @property string $description
 * @property string $image
 * @property integer $quantity
 * @property string $last_update
 *
 * The followings are the available model relations:
 * @property MaterialsUpdateLog[] $materialsUpdateLogs
 */
class Materials extends CActiveRecord
{
	public $oldQuantity;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_materials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sku', 'required'),
			array('quantity', 'numerical', 'integerOnly'=>true),
			array('name, sku, description, image', 'length', 'max'=>255),
			array('last_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, sku, description, image, quantity, last_update', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'materialsUpdateLogs' => array(self::HAS_MANY, 'MaterialsUpdateLog', 'material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'sku' => 'Sku',
			'description' => 'Description',
			'image' => 'Image',
			'quantity' => 'Quantity',
			'last_update' => 'Last Update',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Materials the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function beforeDelete()
	{
		/*delete the image too*/
		$uploadsPath = Yii::getPathOfAlias("uploadedImage");
		if (!is_null($this->image)) {
			$imagePath = $uploadsPath.DIRECTORY_SEPARATOR.$this->image;
			unlink($imagePath);
		}
		
		parent::beforeDelete();
		return true;
	}
	public function beforeSave()
	{
		if (!$this->isNewRecord) {
			/*before deleting , log the event*/
			$materialLogObj = new MaterialsUpdateLog();
			$materialLogObj->material_id = $this->id;
			$materialLogObj->old_quantity = $this->oldQuantity;
			$materialLogObj->new_quantity = $this->quantity;
			$materialLogObj->save();
		}
		$this->last_update = date("Y-m-d H:i:s");
		return parent::beforeSave();
	}

}
