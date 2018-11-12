<?php

/**
 * This is the model class for table "direcciones".
 *
 * The followings are the available columns in table 'direcciones':
 * @property integer $id
 * @property string $nombre_direccion
 * @property integer $ciudad_direccion
 * @property string $linea1_direccion
 * @property string $linea2_direccion
 * @property string $telefono_direccion
 * @property integer $usuario_direccion
 */
class Direcciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'direcciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_direccion, ciudad_direccion, linea1_direccion, linea2_direccion, telefono_direccion, usuario_direccion', 'required'),
			array('ciudad_direccion, usuario_direccion', 'numerical', 'integerOnly'=>true),
			array('nombre_direccion', 'length', 'max'=>30),
			array('linea1_direccion, linea2_direccion', 'length', 'max'=>100),
			array('telefono_direccion', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_direccion, ciudad_direccion, linea1_direccion, linea2_direccion, telefono_direccion, usuario_direccion', 'safe', 'on'=>'search'),
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
			'nombre_direccion' => 'Nombre Direccion',
			'ciudad_direccion' => 'Ciudad Direccion',
			'linea1_direccion' => 'Linea1 Direccion',
			'linea2_direccion' => 'Linea2 Direccion',
			'telefono_direccion' => 'Telefono Direccion',
			'usuario_direccion' => 'Usuario Direccion',
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
		$criteria->compare('nombre_direccion',$this->nombre_direccion,true);
		$criteria->compare('ciudad_direccion',$this->ciudad_direccion);
		$criteria->compare('linea1_direccion',$this->linea1_direccion,true);
		$criteria->compare('linea2_direccion',$this->linea2_direccion,true);
		$criteria->compare('telefono_direccion',$this->telefono_direccion,true);
		$criteria->compare('usuario_direccion',$this->usuario_direccion);

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
	 * @return Direcciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
