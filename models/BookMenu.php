<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_book_menu".
 *
 * @property int $id
 * @property int $menu_id
 * @property string $booking_date
 * @property string $booking_time
 * @property int $number_of_person
 * @property string $updated_on
 * @property int $state_id
 * @property int $type_id
 * @property int $create_user_id
 *
 * @property TblUser $createUser
 * @property TblUser $createUser0
 */
class BookMenu extends \yii\db\ActiveRecord {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public static function tableName() {
		return 'tbl_book_menu';
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'menu_id',
								'create_user_id' 
						],
						'required' 
				],
				[ 
						[ 
								'menu_id',
								'number_of_person',
								'state_id',
								'type_id',
								'create_user_id' 
						],
						'integer' 
				],
				[ 
						[ 
								'booking_date',
								'booking_time',
								'updated_on' 
						],
						'safe' 
				],
				[ 
						[ 
								'create_user_id' 
						],
						'exist',
						'skipOnError' => true,
						'targetClass' => User::className (),
						'targetAttribute' => [ 
								'create_user_id' => 'id' 
						] 
				] 
		
		];
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function attributeLabels() {
		return [ 
				'id' => 'ID',
				'menu_id' => 'Menu ID',
				'booking_date' => 'Booking Date',
				'booking_time' => 'Booking Time',
				'number_of_person' => 'Number Of Person',
				'updated_on' => 'Updated On',
				'state_id' => 'State ID',
				'type_id' => 'Type ID',
				'create_user_id' => 'Create User ID' 
		];
	}
	
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreateUser() {
		return $this->hasOne ( User::className (), [ 
				'id' => 'create_user_id' 
		] );
	}
}
