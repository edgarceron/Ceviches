<?php

/**
 * This is the model class for table "productos".
 *
 * The followings are the available columns in table 'productos':
 * @property integer $id
 * @property string $nombre_producto
 * @property string $descripcion_producto
 * @property string $precio_producto
 * @property integer $calorias_producto
 * @property string $imageng_producto
 * @property string $imagenm_producto
 * @property string $imagenp_producto
 * @property integer $id_tipo_producto
 * @property integer $id_linea_producto
 *
 * The followings are the available model relations:
 * @property TiposProducto $idTipoProducto
 * @property LineasProducto $idLineaProducto
 * @property VariablesProducto[] $variablesProductos
 */
class Productos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_producto, descripcion_producto, precio_producto, calorias_producto, id_tipo_producto, id_linea_producto', 'required'),
			array('calorias_producto, id_tipo_producto, id_linea_producto', 'numerical', 'integerOnly'=>true),
			array('nombre_producto', 'length', 'max'=>30),
			array('precio_producto', 'length', 'max'=>10),
			array('imageng_producto, imagenm_producto, imagenp_producto', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_producto, descripcion_producto, precio_producto, calorias_producto, imageng_producto, imagenm_producto, imagenp_producto, id_tipo_producto, id_linea_producto', 'safe', 'on'=>'search'),
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
			'idTipoProducto' => array(self::BELONGS_TO, 'TiposProducto', 'id_tipo_producto'),
			'idLineaProducto' => array(self::BELONGS_TO, 'LineasProducto', 'id_linea_producto'),
			'variablesProductos' => array(self::HAS_MANY, 'VariablesProducto', 'id_producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_producto' => 'Nombre Producto',
			'descripcion_producto' => 'Descripcion Producto',
			'precio_producto' => 'Precio Producto',
			'calorias_producto' => 'Calorias Producto',
			'imageng_producto' => 'Imageng Producto',
			'imagenm_producto' => 'Imagenm Producto',
			'imagenp_producto' => 'Imagenp Producto',
			'id_tipo_producto' => 'Id Tipo Producto',
			'id_linea_producto' => 'Id Linea Producto',
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
		$criteria->compare('nombre_producto',$this->nombre_producto,true);
		$criteria->compare('descripcion_producto',$this->descripcion_producto,true);
		$criteria->compare('precio_producto',$this->precio_producto,true);
		$criteria->compare('calorias_producto',$this->calorias_producto);
		$criteria->compare('imageng_producto',$this->imageng_producto,true);
		$criteria->compare('imagenm_producto',$this->imagenm_producto,true);
		$criteria->compare('imagenp_producto',$this->imagenp_producto,true);
		$criteria->compare('id_tipo_producto',$this->id_tipo_producto);
		$criteria->compare('id_linea_producto',$this->id_linea_producto);

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
	 * @return Productos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
