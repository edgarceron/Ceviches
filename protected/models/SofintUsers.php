<?php

/**
 * This is the model class for table "sofint_users".
 *
 * The followings are the available columns in table 'sofint_users':
 * @property integer $id
 * @property string $nick
 * @property string $password
 * @property string $nombre
 * @property string $apellido
 * @property integer $telefono
 * @property string $movil
 * @property string $email
 * @property string $foto
 * @property string $direccion
 * @property integer $perfil
 * @property integer $estado
 * @property integer $fecha_creacion
 * @property integer $restablecer
 * @property integer $grupo
 *
 * The followings are the available model relations:
 * @property Recuperar[] $recuperars
 */
class SofintUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sofint_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nick, password, nombre, apellido, email, perfil, estado, fecha_creacion', 'required'),
			array('telefono, perfil, estado, fecha_creacion, restablecer, grupo', 'numerical', 'integerOnly'=>true),
			array('nick', 'length', 'max'=>10),
			array('password, foto', 'length', 'max'=>50),
			array('nombre, apellido', 'length', 'max'=>20),
			array('movil', 'length', 'max'=>11),
			array('email', 'length', 'max'=>40),
			array('direccion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nick, password, nombre, apellido, telefono, movil, email, foto, direccion, perfil, estado, fecha_creacion, restablecer, grupo', 'safe', 'on'=>'search'),
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
			'recuperars' => array(self::HAS_MANY, 'Recuperar', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nick' => 'Nick',
			'password' => 'Password',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'telefono' => 'Telefono',
			'movil' => 'Movil',
			'email' => 'Email',
			'foto' => 'Foto',
			'direccion' => 'Direccion',
			'perfil' => 'Perfil',
			'estado' => 'Estado',
			'fecha_creacion' => 'Fecha Creacion',
			'restablecer' => 'Restablecer',
			'grupo' => 'Grupo',
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
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('telefono',$this->telefono);
		$criteria->compare('movil',$this->movil,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('perfil',$this->perfil);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('fecha_creacion',$this->fecha_creacion);
		$criteria->compare('restablecer',$this->restablecer);
		$criteria->compare('grupo',$this->grupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
	}
	
	public function hashPassword($password)
	{
		return md5($password);
	}   

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SofintUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
