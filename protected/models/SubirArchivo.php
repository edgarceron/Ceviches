<?php

class SubirArchivo extends CModel
{
	public $datos;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('ano, mes, punto, zona, indicador, resultado_real, presupuesto, dat1, dat2, dat3, meta, ponderado, calificacion_0, calificacion_1, calificacion_2, calificacion_3, calificacion_4, calificacion_5, calificacion_6, calificacion_7, calificacion_8, calificacion_9, calificacion_10, dat4, dat5, dat6, dat7, dat8, dat9, dat10, dat11, dat12, dat13', 'required'),
			array('datos', 'file', 'types'=>'csv', 'safe' => true),
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
			'datos' => 'Subir CSV',
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