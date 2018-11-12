<?php

/**
 * This is the model class for table "sofint_config".
 *
 * The followings are the available columns in table 'sofint_config':
 * @property integer $id
 * @property string $nombre
 * @property string $nit
 * @property string $direccion
 * @property string $telefono
 * @property string $movil
 * @property string $web
 * @property string $logo
 * @property string $gcalid
 * @property string $gmailuser
 * @property string $gmailclave
 * @property string $asterurl
 * @property string $asteruser
 * @property string $asterclave
 * @property integer $dat1
 * @property string $dat2
 * @property string $dat3
 * @property string $dat4
 * @property string $dat5
 * @property string $dat6
 * @property string $dat7
 * @property string $dat8
 * @property string $dat9
 * @property string $dat10
 */
class SofintConfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sofint_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, nit, direccion, telefono, movil, web, logo, gcalid, gmailuser, gmailclave, asterurl, asteruser, asterclave, dat1, dat2, dat3, dat4, dat5, dat6, dat7, dat8, dat9, dat10', 'required'),
			array('dat1', 'numerical', 'integerOnly'=>true),
			array('nombre, nit, logo, gcalid, gmailuser, gmailclave, asterurl, asteruser, asterclave, dat2, dat3, dat4, dat5, dat6, dat7, dat8, dat9', 'length', 'max'=>100),
			array('telefono, movil', 'length', 'max'=>20),
			array('web', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, nit, direccion, telefono, movil, web, logo, gcalid, gmailuser, gmailclave, asterurl, asteruser, asterclave, dat1, dat2, dat3, dat4, dat5, dat6, dat7, dat8, dat9, dat10', 'safe', 'on'=>'search'),
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
			'nit' => 'Nit',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'movil' => 'Movil',
			'web' => 'Web',
			'logo' => 'Logo',
			'gcalid' => 'Gcalid',
			'gmailuser' => 'Gmailuser',
			'gmailclave' => 'Gmailclave',
			'asterurl' => 'Asterurl',
			'asteruser' => 'Asteruser',
			'asterclave' => 'Asterclave',
			'dat1' => 'Dat1',
			'dat2' => 'Dat2',
			'dat3' => 'Dat3',
			'dat4' => 'Dat4',
			'dat5' => 'Dat5',
			'dat6' => 'Dat6',
			'dat7' => 'Dat7',
			'dat8' => 'Dat8',
			'dat9' => 'Dat9',
			'dat10' => 'Dat10',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('movil',$this->movil,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('gcalid',$this->gcalid,true);
		$criteria->compare('gmailuser',$this->gmailuser,true);
		$criteria->compare('gmailclave',$this->gmailclave,true);
		$criteria->compare('asterurl',$this->asterurl,true);
		$criteria->compare('asteruser',$this->asteruser,true);
		$criteria->compare('asterclave',$this->asterclave,true);
		$criteria->compare('dat1',$this->dat1);
		$criteria->compare('dat2',$this->dat2,true);
		$criteria->compare('dat3',$this->dat3,true);
		$criteria->compare('dat4',$this->dat4,true);
		$criteria->compare('dat5',$this->dat5,true);
		$criteria->compare('dat6',$this->dat6,true);
		$criteria->compare('dat7',$this->dat7,true);
		$criteria->compare('dat8',$this->dat8,true);
		$criteria->compare('dat9',$this->dat9,true);
		$criteria->compare('dat10',$this->dat10,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SofintConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
