<?php
namespace app\models;


/**
 * This is the model class for table "{{%tbl_menu}}".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $content
 * @property int $price
 * @property int $time_to_prepare
 * @property string $created_on
 * @property string $updated_on
 * @property int $state_id
 * @property int $type_id
 * @property int $create_user_id
 *
 * @property TblCategory $category
 * @property TblUser $createUser
 * @property TblUser $createUser0
 * @property TblCategory $category0
 */
class Menu extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{tbl_menu}}';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'category_id',
                    'create_user_id'
                ],
                'required'
            ],
            [
                [
                    'category_id',
                    'price',
                    'time_to_prepare',
                    'state_id',
                    'type_id',
                    'create_user_id'
                ],
                'integer'
            ],
            [
                [
                    'created_on',
                    'updated_on'
                ],
                'safe'
            ],
            [
                [
                    'title'
                ],
                'string',
                'max' => 127
            ],
            [
                [
                    'content'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'category_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
                'targetAttribute' => [
                    'category_id' => 'id'
                ]
            ],
            [
                [
                    'create_user_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => [
                    'create_user_id' => 'id'
                ]
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'content' => 'Content',
            'price' => 'Price',
            'time_to_prepare' => 'Time To Prepare',
            'created_on' => 'Created On',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }
}
