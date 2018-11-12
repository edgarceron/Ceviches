<?php

/**
 * This is the model class for table "perfil_contenido".
 *
 * The followings are the available columns in table 'perfil_contenido':
 * @property integer $id
 * @property string $modulo
 * @property string $controlador
 * @property string $accion
 * @property integer $estado
 * @property integer $perfil
 * @property string $fecha_creacion
 */
class PerfilContenido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'perfil_contenido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modulo, controlador, accion, estado, perfil, fecha_creacion', 'required'),
			array('estado, perfil', 'numerical', 'integerOnly'=>true),
			array('modulo, controlador, accion, fecha_creacion', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, modulo, controlador, accion, estado, perfil, fecha_creacion', 'safe', 'on'=>'search'),
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
			'modulo' => 'Modulo',
			'controlador' => 'Controlador',
			'accion' => 'Accion',
			'estado' => 'Estado',
			'perfil' => 'Perfil',
			'fecha_creacion' => 'Fecha Creacion',
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
		$criteria->compare('modulo',$this->modulo,true);
		$criteria->compare('controlador',$this->controlador,true);
		$criteria->compare('accion',$this->accion,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PerfilContenido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
