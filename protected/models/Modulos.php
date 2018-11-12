<?php

/**
 * This is the model class for table "modulos".
 *
 * The followings are the available columns in table 'modulos':
 * @property string $id
 * @property string $nombre
 * @property integer $estado
 * @property string $fecha_creacion
 * @property string $version
 * @property string $desarrollador
 */
class Modulos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modulos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, nombre, estado, fecha_creacion, version, desarrollador', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('id, nombre, fecha_creacion, version', 'length', 'max'=>20),
			array('desarrollador', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, estado, fecha_creacion, version, desarrollador', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'estado' => 'Estado',
			'fecha_creacion' => 'Fecha Creacion',
			'version' => 'Version',
			'desarrollador' => 'Desarrollador',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('desarrollador',$this->desarrollador,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modulos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
