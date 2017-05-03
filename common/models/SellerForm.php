<?php

/**
 * This is the model class for table "seller_form".
 *
 * The followings are the available columns in table 'seller_form':
 * @property string $id
 * @property string $user_id
 * @property integer $start_sum
 * @property integer $end_sum
 * @property string $date
 */
class SellerForm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SellerForm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seller_form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, start_sum', 'required'),
			array('start_sum, end_sum', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, start_sum, end_sum, date', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'User','user_id'),
            'sales' => array(self::HAS_MANY, 'SellerFormSale','seller_form_id'),
            'expenses' => array(self::HAS_MANY, 'SellerFormExpense','seller_form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'ФИО',
			'start_sum' => 'Сумма в кассе на начало смены',
			'end_sum' => 'Сумма в кассе на конец смены',
			'date' => 'Дата',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('start_sum',$this->start_sum);
		$criteria->compare('end_sum',$this->end_sum);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getCash(){
        $sum = 0;
        $expenses = 0;
        foreach ($this->sales as $sale) {
            if($sale->payment_type == 1)
                $sum += $sale->total;
        }

        foreach ($this->expenses as $expense) {
            $expenses += $expense->amount;
        }

        return $this->start_sum + $sum - $expenses;
    }

    public function getTotal(){
        $sum = 0;

        foreach ($this->sales as $sale) {
                $sum += $sale->total;
        }

        return $sum;
    }
}