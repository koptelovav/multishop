<?php

/**
 * This is the model class for table "order_log".
 *
 * The followings are the available columns in table 'order_log':
 * @property string $id
 * @property string $order_id
 * @property string $user_id
 * @property string $action
 * @property string $field
 * @property string $description
 * @property string $date
 */
class OrderLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderLog the static model class
	 */
    protected static $tAction = array(
        'update' => 'изменено',
    );


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, user_id, action, field, description', 'required'),
			array('order_id, user_id', 'length', 'max'=>10),
			array('action', 'length', 'max'=>6),
			array('field', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, user_id, action, field, description, date', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'user_id' => 'User',
			'action' => 'Action',
			'field' => 'Field',
			'description' => 'Description',
			'date' => 'Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('field',$this->field,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getOrderHistory($orderId){
        return self::model()->findAllByAttributes(array(
            'order_id' => $orderId
        ));
    }

    public function writeFromEditableServer($event){
        $editableServer = $event->sender;
        $this->user_id = Yii::app()->user->id ? Yii::app()->user->id : 1;
        $this->field = $editableServer->attribute;

        switch($editableServer->modelClass){
            case 'Orders':
                $this->order_id = $editableServer->primaryKey;
                break;
            case 'CustomerEntityInfo':
            case 'CustomerAddress':
            case 'Customers':
                $this->order_id = Orders::model()->findByAttributes(array(
                    'customer_id'=>$editableServer->primaryKey
                ))->id;
        }

        if(!$editableServer->model->oldAttributes[$editableServer->attribute]){
            $this->action = 'add';
        }elseif(!$editableServer->model->{$editableServer->attribute}){
            $this->action = 'delete';
        }else{
            $this->action = 'update';
        }

        $this->{$this->action.$editableServer->modelClass}($editableServer);
        $this->save();
    }

    protected function addOrders($editableServer){
        switch($editableServer->attribute){
            case 'status':
                $this->description = '<span>Статус заказа</span> установлен в';
                $this->description .= '<span>'.OrderStatus::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'payment_status':
                $this->description = '<span>Статус оплаты</span> установлен в ';
                $this->description .= '<span>'.OrderPaymentStatus::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'shipping_id':
                $this->description = 'Установлен <span>тип доставки</span> ';
                $this->description .= '<span>'.Shipping::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'payment_id':
                $this->description = 'Установлен тип<span>оплаты</span> ';
                $this->description .= '<span>'.Payment::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'shipping_price':
                $this->description = 'Установлена <span>стоимость доставки</span> ';
                break;

            case 'discount':
                $this->description = 'Установлена <span>скидка</span> ';
                break;

            case 'track':
                $this->description = 'Вписан <span>трэк-номер</span> ';
                break;

            case 'priority':
                $this->description = 'Установлен <span>приоритет</span> ';
                break;
            case 'comment':
                $this->description = 'Добавлен <span>комментарий покупателя</span> ';
                break;
        }
        switch($editableServer->attribute){
            case 'shipping_price':
            case 'discount':
            case 'track':
            case 'priority':
            case 'comment':
                $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
                break;
        }
    }
    protected function deleteOrders($editableServer){
        switch($editableServer->attribute){
            case 'shipping_price':
                $this->description = 'Удалена <span>стоимость доставки</span>, предыдущая стоимсоть ';
                break;

            case 'discount':
                $this->description = 'Удалена <span>скидка</span>, предыдущая скидка ';
                break;

            case 'track':
                $this->description = 'Удален <span>трэк-номер</span>, предыдущий трэк-номер ';
                break;

            case 'comment':
                $this->description = 'Удален <span>комментврий пользователя</span>, предыдущий комментврий';
                break;
        }

        switch($editableServer->attribute){
            case 'shipping_price':
            case 'discount':
            case 'track':
            case 'comment':
                $this->description .= '<span>'.$editableServer->model->oldAttributes[$editableServer->attribute].'</span>';
                break;
        }
    }
    protected function updateOrders($editableServer){
        switch($editableServer->attribute){
            case 'status':
                $this->description = '<span>Статус заказа</span> изменен с ';
                $this->description .= '<span>'.OrderStatus::model()->findByPk($editableServer->model->oldAttributes[$editableServer->attribute])->name.'</span>';
                $this->description .= ' на ';
                $this->description .= '<span>'.OrderStatus::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
            break;

            case 'payment_status':
                $this->description = '<span>Статус оплаты</span> изменен с ';
                $this->description .= '<span>'.OrderPaymentStatus::model()->findByPk($editableServer->model->oldAttributes[$editableServer->attribute])->name.'</span>';
                $this->description .= ' на ';
                $this->description .= '<span>'.OrderPaymentStatus::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'shipping_id':
                $this->description = '<span>Доставка</span> изменена с ';
                $this->description .= '<span>'.Shipping::model()->findByPk($editableServer->model->oldAttributes[$editableServer->attribute])->name.'</span>';
                $this->description .= ' на ';
                $this->description .= '<span>'.Shipping::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'payment_id':
                $this->description = '<span>Оплата</span> изменена с ';
                $this->description .= '<span>'.Payment::model()->findByPk($editableServer->model->oldAttributes[$editableServer->attribute])->name.'</span>';
                $this->description .= ' на ';
                $this->description .= '<span>'.Payment::model()->findByPk($editableServer->model->{$editableServer->attribute})->name.'</span>';
                break;

            case 'shipping_price':
                $this->description = '<span>Стоимость доставки</span> изменена с ';
                break;

            case 'discount':
                $this->description = '<span>Скидка</span> изменена с ';
                break;

            case 'track':
                $this->description = '<span>Трэк-номер</span> изменен с ';
                break;

            case 'priority':
                $this->description = '<span>Приоритет</span> изменена с ';
                break;

            case 'comment':
                $this->description = '<span>Комментарий пользователя</span> изменен с ';
                break;
        }
        switch($editableServer->attribute){
            case 'shipping_price':
            case 'discount':
            case 'track':
            case 'priority':
            case 'comment':
                $this->description .= '<span>'.$editableServer->model->oldAttributes[$editableServer->attribute].'</span>';
                $this->description .= ' на ';
                $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
                break;
        }
    }

    protected function addCustomers($editableServer){
        switch($editableServer->attribute){
            case 'name':
                $this->description = 'Добавлены <span>Ф.И.О. покупателя</span>: ';
                break;
            case 'phone':
                $this->description = 'Добавлен <span>телефон покупателя</span>: ';
                break;
            case 'email':
                $this->description = 'Добавлен <span>e-mail покупателя</span>: ';
                break;
        }
        $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
    }
    protected function deleteCustomers($editableServer){

    }
    protected function updateCustomers($editableServer){
        switch($editableServer->attribute){
            case 'name':
                $this->description = '<span>Ф.И.О. покупателя</span> изменены с ';
                break;
            case 'phone':
                $this->description = '<span>Телефон покупателя</span> изменен с ';
                break;
            case 'email':
                $this->description = '<span>E-mail</span> изменен с ';
                break;
        }

        $this->description .= '<span>'.$editableServer->model->oldAttributes[$editableServer->attribute].'</span>';
        $this->description .= ' на ';
        $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
    }

    protected function addCustomerAddress($editableServer){
        switch($editableServer->attribute){
            case 'zip':
                $this->description = 'Добавлен <span>индекс покупателя</span>: ';
                break;
            case 'city':
                $this->description = 'Добавлен <span>город покупателя</span>: ';
                break;
            case 'area':
                $this->description = 'Добавлен <span>регион покупателя</span>: ';
                break;
            case 'address':
                $this->description = 'Добавлен <span>адрес покупателя</span>: ';
                break;
        }
        $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
    }
    protected function deleteCustomerAddress($editableServer){
        switch($editableServer->attribute){
            case 'zip':
                $this->description = 'Удален <span>индекс покупателя</span>, предыдущий индекс ';
                break;
            case 'city':
                $this->description = 'Удален <span>город покупателя</span>, предыдущий город ';
                break;
            case 'area':
                $this->description = 'Удален <span>регион покупателя</span>, предыдущий регион ';
                break;
            case 'address':
                $this->description = 'Удален <span>адрес покупателя</span>, предыдущий адрес ';
                break;
        }
        $this->description .= '<span>'.$editableServer->model->oldAttributes[$editableServer->attribute].'</span>';
    }
    protected function updateCustomerAddress($editableServer){
        switch($editableServer->attribute){
            case 'zip':
                $this->description = '<span>Индекс покупателя</span> изменен с ';
                break;
            case 'city':
                $this->description = '<span>Город покупателя</span> изменен с ';
                break;
            case 'area':
                $this->description = '<span>Регион покупателя</span> изменен с ';
                break;
            case 'address':
                $this->description = '<span>Адрес покупателя</span> изменен с ';
                break;
        }

        $this->description .= '<span>'.$editableServer->model->oldAttributes[$editableServer->attribute].'</span>';
        $this->description .= ' на ';
        $this->description .= '<span>'.$editableServer->model->{$editableServer->attribute}.'</span>';
    }

    protected function addCustomerEntityInfo(){}
    protected function deleteCustomerEntityInfo(){}
    protected function updateCustomerEntityInfo(){}
}