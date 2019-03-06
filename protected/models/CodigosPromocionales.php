<?php

/**
 * This is the model class for table "codigos_promocionales".
 *
 * The followings are the available columns in table 'codigos_promocionales':
 * @property integer $id
 * @property string $codigo
 * @property integer $tipo
 * @property double $valor
 * @property string $mensaje
 * @property string $valido_desde
 * @property string $valido_hasta
 *
 * The followings are the available model relations:
 * @property Pedidos[] $pedidoses
 * @property TemporalPedido[] $temporalPedidos
 */
class CodigosPromocionales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'codigos_promocionales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, tipo, valor, mensaje, valido_desde, valido_hasta', 'required'),
			array('tipo', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			array('codigo', 'length', 'max'=>30),
			array('mensaje', 'length', 'max'=>280),
			array('valor', 'compare', 'compareValue' => 0, 'operator' => '>='),
			array('valido_hasta', 'compare', 'compareAttribute' => 'valido_desde', 'operator' => '>=', 'message' => 'Valido hasta debe ser mayor que valido desde'),
			array('valor', 'compare', 'compareValue' => 100, 'operator' => '<=', 
				'message' => 'Si el tipo es porcentaje, el valor debe ser menor o igual que 100', 'on'=>'porcentaje'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codigo, tipo, valor, mensaje, valido_desde, valido_hasta', 'safe', 'on'=>'search'),
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
			'pedidoses' => array(self::HAS_MANY, 'Pedidos', 'id_codigo_pedido'),
			'temporalPedidos' => array(self::HAS_MANY, 'TemporalPedido', 'id_codigo_pedido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'tipo' => 'Tipo',
			'valor' => 'Valor',
			'mensaje' => 'Mensaje',
			'valido_desde' => 'Valido Desde',
			'valido_hasta' => 'Valido Hasta',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('valido_desde',$this->valido_desde,true);
		$criteria->compare('valido_hasta',$this->valido_hasta,true);

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
	
	public static function getTipos(){
		return array(1 => "Porcentaje", 2 => "Valor");
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CodigosPromocionales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
