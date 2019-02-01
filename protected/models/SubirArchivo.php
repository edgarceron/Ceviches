<?php

class SubirArchivo extends CModel
{
	public $datos;
	public $datos1;
	public $datos2;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('datos, datos1, datos2', 'file', 'types'=>'csv', 'safe' => true),
		);
	}
	
	public function upload()
    {
        if ($this->validate()) {
            //$this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeNames()
	{
		return array(
			'datos' => 'Subir imagen grande',
			'datos1' => 'Subir imagen mediana',
			'datos2' => 'Subir imagen pequeña',
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'datos' => 'Subir imagen grande',
			'datos1' => 'Subir imagen mediana',
			'datos2' => 'Subir imagen pequeña',
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
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IngresoDatos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}