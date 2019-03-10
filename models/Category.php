<?php
namespace app\models;

use Yii;
use app\components\BaseActiveRecord;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created_on
 * @property string $updated_on
 * @property int $state_id
 * @property int $type_id
 * @property int $create_user_id
 *
 * @property TblUser $createUser
 * @property TblUser $createUser0
 * @property TblPost[] $tblPosts
 * @property TblPost[] $tblPosts0
 */
class Category extends BaseActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
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
                    'create_user_id'
                ],
                'required'
            ],
            [
                [
                    'created_on',
                    'updated_on',
                    'file'
                ],
                'safe'
            ],
            [
                [
                    'state_id',
                    'type_id',
                    'create_user_id'
                ],
                'integer'
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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'state_id' => Yii::t('app', 'State ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'create_user_id' => Yii::t('app', 'Create User ID')
        ];
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

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser0()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPosts()
    {
        return $this->hasMany(Post::className(), [
            'category_id' => 'id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPosts0()
    {
        return $this->hasMany(Post::className(), [
            'category_id' => 'id'
        ]);
    }
}
