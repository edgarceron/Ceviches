<?php

/**
 * This is the model class for table "servicios_mu".
 *
 * The followings are the available columns in table 'servicios_mu':
 * @property integer $id_pedido
 * @property string $uuid
 * @property integer $status
 * @property double $total
 * @property string $date
 * @property integer $distance
 * @property string $error
 * @property integer $task_id
 *
 * The followings are the available model relations:
 * @property Pedidos $idPedido
 */
class ServiciosMu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicios_mu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pedido, uuid, status, total, date, distance, task_id', 'required'),
			array('id_pedido, status, distance, task_id', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('uuid', 'length', 'max'=>15),
			array('error', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pedido, uuid, status, total, date, distance, error, task_id', 'safe', 'on'=>'search'),
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
			'idPedido' => array(self::BELONGS_TO, 'Pedidos', 'id_pedido'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pedido' => 'Id Pedido',
			'uuid' => 'Uuid',
			'status' => 'Status',
			'total' => 'Total',
			'date' => 'Date',
			'distance' => 'Distance',
			'error' => 'Error',
			'task_id' => 'Task',
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

		$criteria->compare('id_pedido',$this->id_pedido);
		$criteria->compare('uuid',$this->uuid,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('total',$this->total);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('distance',$this->distance);
		$criteria->compare('error',$this->error,true);
		$criteria->compare('task_id',$this->task_id);

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
	 * @return ServiciosMu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
