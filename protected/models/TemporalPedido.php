<?php

/**
 * This is the model class for table "temporal_pedido".
 *
 * The followings are the available columns in table 'temporal_pedido':
 * @property integer $id
 * @property string $direccion
 * @property string $medio_pago
 * @property string $items_string
 * @property string $fecha
 * @property integer $id_pedido_finalizado
 * @property integer $codigo_promocional_id
 */
class TemporalPedido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temporal_pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('direccion, medio_pago, items_string', 'required'),
			array('id_pedido_finalizado, codigo_promocional_id', 'numerical', 'integerOnly'=>true),
			array('direccion', 'length', 'max'=>270),
			array('medio_pago', 'length', 'max'=>30),
			array('items_string', 'length', 'max'=>300),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, direccion, medio_pago, items_string, fecha, id_pedido_finalizado, codigo_promocional_id', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'direccion' => 'Direccion',
			'medio_pago' => 'Medio Pago',
			'items_string' => 'Items String',
			'fecha' => 'Fecha',
			'id_pedido_finalizado' => 'Id Pedido Finalizado',
			'codigo_promocional_id' => 'Codigo Promocional',
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
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('medio_pago',$this->medio_pago,true);
		$criteria->compare('items_string',$this->items_string,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('id_pedido_finalizado',$this->id_pedido_finalizado);
		$criteria->compare('codigo_promocional_id',$this->codigo_promocional_id);

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
	 * @return TemporalPedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
