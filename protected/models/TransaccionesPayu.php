<?php

/**
 * This is the model class for table "transacciones_payu".
 *
 * The followings are the available columns in table 'transacciones_payu':
 * @property integer $id_temporal
 * @property string $state_pol
 * @property string $response_code_pol
 * @property string $reference_pol
 * @property integer $payment_method_type
 * @property double $additional_value
 * @property string $transaction_date
 * @property string $currency
 * @property string $cus
 * @property integer $test
 * @property double $administrative_fee
 * @property double $administrative_fee_base
 * @property double $administrative_fee_tax
 * @property double $commision_pol
 * @property string $commision_pol_currency
 * @property double $tax
 * @property double $value
 * @property string $post
 */
class TransaccionesPayu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transacciones_payu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_temporal', 'required'),
			array('id_temporal, payment_method_type, test', 'numerical', 'integerOnly'=>true),
			array('additional_value, administrative_fee, administrative_fee_base, administrative_fee_tax, commision_pol, tax, value', 'numerical'),
			array('state_pol', 'length', 'max'=>32),
			array('response_code_pol, reference_pol', 'length', 'max'=>255),
			array('currency, commision_pol_currency', 'length', 'max'=>3),
			array('cus', 'length', 'max'=>64),
			array('transaction_date, post', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_temporal, state_pol, response_code_pol, reference_pol, payment_method_type, additional_value, transaction_date, currency, cus, test, administrative_fee, administrative_fee_base, administrative_fee_tax, commision_pol, commision_pol_currency, tax, value, post', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_temporal' => 'Id Temporal',
			'state_pol' => 'State Pol',
			'response_code_pol' => 'Response Code Pol',
			'reference_pol' => 'Reference Pol',
			'payment_method_type' => 'Payment Method Type',
			'additional_value' => 'Additional Value',
			'transaction_date' => 'Transaction Date',
			'currency' => 'Currency',
			'cus' => 'Cus',
			'test' => 'Test',
			'administrative_fee' => 'Administrative Fee',
			'administrative_fee_base' => 'Administrative Fee Base',
			'administrative_fee_tax' => 'Administrative Fee Tax',
			'commision_pol' => 'Commision Pol',
			'commision_pol_currency' => 'Commision Pol Currency',
			'tax' => 'Tax',
			'value' => 'Value',
			'post' => 'Post',
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

		$criteria->compare('id_temporal',$this->id_temporal);
		$criteria->compare('state_pol',$this->state_pol,true);
		$criteria->compare('response_code_pol',$this->response_code_pol,true);
		$criteria->compare('reference_pol',$this->reference_pol,true);
		$criteria->compare('payment_method_type',$this->payment_method_type);
		$criteria->compare('additional_value',$this->additional_value);
		$criteria->compare('transaction_date',$this->transaction_date,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('cus',$this->cus,true);
		$criteria->compare('test',$this->test);
		$criteria->compare('administrative_fee',$this->administrative_fee);
		$criteria->compare('administrative_fee_base',$this->administrative_fee_base);
		$criteria->compare('administrative_fee_tax',$this->administrative_fee_tax);
		$criteria->compare('commision_pol',$this->commision_pol);
		$criteria->compare('commision_pol_currency',$this->commision_pol_currency,true);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('value',$this->value);
		$criteria->compare('post',$this->post,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->tienda;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransaccionesPayu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
