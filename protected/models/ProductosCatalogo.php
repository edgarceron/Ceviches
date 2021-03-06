<?php

/**
 * This is the model class for table "productos_catalogo".
 *
 * The followings are the available columns in table 'productos_catalogo':
 * @property integer $id_catalogo
 * @property integer $id_producto
 * @property integer $posicion
 */
class ProductosCatalogo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productos_catalogo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_catalogo, id_producto', 'required'),
			array('id_catalogo, id_producto, posicion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_catalogo, id_producto, posicion', 'safe', 'on'=>'search'),
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
			'idCatalogo' => array(self::BELONGS_TO, 'Catalogos', 'id_catalogo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_catalogo' => 'Id Catalogo',
			'id_producto' => 'Id Producto',
			'posicion' => 'Posicion',
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

		$criteria->compare('id_catalogo',$this->id_catalogo);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('posicion',$this->posicion);

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
	 * @return ProductosCatalogo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
