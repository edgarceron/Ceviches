<?php

/**
 * This is the model class for table "catalogos".
 *
 * The followings are the available columns in table 'catalogos':
 * @property integer $id
 * @property string $nombre_catalogo
 * @property integer $orden_catalogo
 *
 * The followings are the available model relations:
 * @property Productos[] $productoses
 */
class Catalogos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalogos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_catalogo', 'required'),
			array('orden_catalogo', 'numerical', 'integerOnly'=>true),
			array('nombre_catalogo', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_catalogo, orden_catalogo', 'safe', 'on'=>'search'),
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
			'productoses' => array(self::MANY_MANY, 'Productos', 'productos_catalogo(id_catalogo, id_producto)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_catalogo' => 'Nombre Catalogo',
			'orden_catalogo' => 'Forma de ordenamiento',
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
		$criteria->compare('nombre_catalogo',$this->nombre_catalogo,true);
		$criteria->compare('orden_catalogo',$this->orden_catalogo);

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
	 * @return Catalogos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
