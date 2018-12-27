<?php

/**
 * This is the model class for table "detalles".
 *
 * The followings are the available columns in table 'detalles':
 * @property integer $id_pedido
 * @property string $descripcion_detalle
 * @property double $valor_unitario_detalle
 * @property integer $cantidad_detalle
 * @property string $foto_detalle
 *
 * The followings are the available model relations:
 * @property Pedidos $idPedido
 */
class Detalles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pedido, descripcion_detalle, valor_unitario_detalle, cantidad_detalle, foto_detalle', 'required'),
			array('id_pedido, cantidad_detalle', 'numerical', 'integerOnly'=>true),
			array('valor_unitario_detalle', 'numerical'),
			array('descripcion_detalle', 'length', 'max'=>100),
			array('foto_detalle', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pedido, descripcion_detalle, valor_unitario_detalle, cantidad_detalle, foto_detalle', 'safe', 'on'=>'search'),
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
			'idPedido' => array(self::BELONGS_TO, 'Pedidos', 'id_pedido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pedido' => 'Id Pedido',
			'descripcion_detalle' => 'Descripcion Detalle',
			'valor_unitario_detalle' => 'Valor Unitario Detalle',
			'cantidad_detalle' => 'Cantidad Detalle',
			'foto_detalle' => 'Foto Detalle',
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

		$criteria->compare('id_pedido',$this->id_pedido);
		$criteria->compare('descripcion_detalle',$this->descripcion_detalle,true);
		$criteria->compare('valor_unitario_detalle',$this->valor_unitario_detalle);
		$criteria->compare('cantidad_detalle',$this->cantidad_detalle);
		$criteria->compare('foto_detalle',$this->foto_detalle,true);

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
	 * @return Detalles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}