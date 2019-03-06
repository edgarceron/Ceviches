<?php

/**
 * This is the model class for table "pedidos".
 *
 * The followings are the available columns in table 'pedidos':
 * @property integer $id
 * @property integer $id_usuario_pedido
 * @property string $fecha_pedido
 * @property string $estado_pedido
 * @property string $direccion_pedido
 * @property string $medio_pago_pedido
 * @property string $cookie_pedido
 * @property string $codigo_promocional_pedido
 * @property double $descuento_pedido
 * @property string $luigi_pedido
 * @property double $domicilio_pedido
 * @property integer $id_codigo_pedido
 *
 * The followings are the available model relations:
 * @property Detalles[] $detalles
 * @property ProgramacionPedido[] $programacionPedidos
 * @property ServiciosMu $serviciosMu
 */
class Pedidos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedidos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario_pedido, fecha_pedido, estado_pedido, direccion_pedido, medio_pago_pedido, cookie_pedido, descuento_pedido, luigi_pedido', 'required'),
			array('id_usuario_pedido, id_codigo_pedido', 'numerical', 'integerOnly'=>true),
			array('descuento_pedido, domicilio_pedido', 'numerical'),
			array('estado_pedido, medio_pago_pedido, codigo_promocional_pedido', 'length', 'max'=>30),
			array('direccion_pedido', 'length', 'max'=>220),
			array('cookie_pedido', 'length', 'max'=>300),
			array('luigi_pedido', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_usuario_pedido, fecha_pedido, estado_pedido, direccion_pedido, medio_pago_pedido, cookie_pedido, codigo_promocional_pedido, descuento_pedido, luigi_pedido, domicilio_pedido, id_codigo_pedido', 'safe', 'on'=>'search'),
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
			'detalles' => array(self::HAS_MANY, 'Detalles', 'id_pedido'),
			'programacionPedidos' => array(self::HAS_MANY, 'ProgramacionPedido', 'id_pedido'),
			'serviciosMu' => array(self::HAS_ONE, 'ServiciosMu', 'id_pedido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_usuario_pedido' => 'Id Usuario Pedido',
			'fecha_pedido' => 'Fecha Pedido',
			'estado_pedido' => 'Estado Pedido',
			'direccion_pedido' => 'Direccion Pedido',
			'medio_pago_pedido' => 'Medio Pago Pedido',
			'cookie_pedido' => 'Cookie Pedido',
			'codigo_promocional_pedido' => 'Codigo Promocional Pedido',
			'descuento_pedido' => 'Descuento Pedido',
			'luigi_pedido' => 'Luigi Pedido',
			'domicilio_pedido' => 'Domicilio Pedido',
			'id_codigo_pedido' => 'Id Codigo Pedido',
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
		$criteria->compare('id_usuario_pedido',$this->id_usuario_pedido);
		$criteria->compare('fecha_pedido',$this->fecha_pedido,true);
		$criteria->compare('estado_pedido',$this->estado_pedido,true);
		$criteria->compare('direccion_pedido',$this->direccion_pedido,true);
		$criteria->compare('medio_pago_pedido',$this->medio_pago_pedido,true);
		$criteria->compare('cookie_pedido',$this->cookie_pedido,true);
		$criteria->compare('codigo_promocional_pedido',$this->codigo_promocional_pedido,true);
		$criteria->compare('descuento_pedido',$this->descuento_pedido);
		$criteria->compare('luigi_pedido',$this->luigi_pedido,true);
		$criteria->compare('domicilio_pedido',$this->domicilio_pedido);
		$criteria->compare('id_codigo_pedido',$this->id_codigo_pedido);

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
	 * @return Pedidos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
