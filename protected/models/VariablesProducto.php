<?php

/**
 * This is the model class for table "variables_producto".
 *
 * The followings are the available columns in table 'variables_producto':
 * @property integer $id_producto
 * @property integer $id_tipo_variable
 * @property integer $id_variable
 * @property integer $afecta_precio
 * @property string $precio
 *
 * The followings are the available model relations:
 * @property Productos $idProducto
 * @property TiposVariable $idTipoVariable
 * @property Variables $idVariable
 */
class VariablesProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'variables_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_producto, id_tipo_variable, id_variable, afecta_precio, precio', 'required'),
			array('id_producto, id_tipo_variable, id_variable, afecta_precio', 'numerical', 'integerOnly'=>true),
			array('precio', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_producto, id_tipo_variable, id_variable, afecta_precio, precio', 'safe', 'on'=>'search'),
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
			'idProducto' => array(self::BELONGS_TO, 'Productos', 'id_producto'),
			'idTipoVariable' => array(self::BELONGS_TO, 'TiposVariable', 'id_tipo_variable'),
			'idVariable' => array(self::BELONGS_TO, 'Variables', 'id_variable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_producto' => 'Id Producto',
			'id_tipo_variable' => 'Id Tipo Variable',
			'id_variable' => 'Id Variable',
			'afecta_precio' => 'Afecta Precio',
			'precio' => 'Precio',
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

		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('id_tipo_variable',$this->id_tipo_variable);
		$criteria->compare('id_variable',$this->id_variable);
		$criteria->compare('afecta_precio',$this->afecta_precio);
		$criteria->compare('precio',$this->precio,true);

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
	 * @return VariablesProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
