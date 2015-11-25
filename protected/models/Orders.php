<?php

/**
 * This is the model class for table "tbl_orders".
 *
 * The followings are the available columns in table 'tbl_orders':
 * @property integer $id
 * @property integer $customer_id
 * @property string $invoice_number
 * @property double $sub_total
 * @property double $tax
 * @property double $shipping_amt
 * @property double $total_amt
 * @property double $paid
 * @property double $change
 * @property string $sales_person
 * @property string $shipping_address
 * @property string $ship_date
 * @property string $note
 * @property string $order_date
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property ProductOrders[] $productOrders
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id', 'numerical', 'integerOnly'=>true),
			array('sub_total, tax, shipping_amt, total_amt, paid, change', 'numerical'),
			array('invoice_number, sales_person, shipping_address', 'length', 'max'=>255),
			array('ship_date, note, order_date, date_created, date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, invoice_number, sub_total, tax, shipping_amt, total_amt, paid, change, sales_person, shipping_address, ship_date, note, order_date, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'productOrders' => array(self::HAS_MANY, 'ProductOrders', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'invoice_number' => 'Invoice Number',
			'sub_total' => 'Sub Total',
			'tax' => 'Tax',
			'shipping_amt' => 'Shipping Amt',
			'total_amt' => 'Total Amt',
			'paid' => 'Paid',
			'change' => 'Change',
			'sales_person' => 'Sales Person',
			'shipping_address' => 'Shipping Address',
			'ship_date' => 'Ship Date',
			'note' => 'Note',
			'order_date' => 'Order Date',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('sub_total',$this->sub_total);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('shipping_amt',$this->shipping_amt);
		$criteria->compare('total_amt',$this->total_amt);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('change',$this->change);
		$criteria->compare('sales_person',$this->sales_person,true);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('ship_date',$this->ship_date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
           'CTimestampBehavior' => array(
               'class' => 'zii.behaviors.CTimestampBehavior',
               'createAttribute' => 'date_created',
               'updateAttribute' => 'date_updated',
           )
        );
        
    }
	
}
