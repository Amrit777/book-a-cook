<?php
namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_sub_header}}".
 *
 * @property int $id
 * @property int $header_id
 * @property string $title
 * @property string $link_url
 * @property int $state_id
 * @property int $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property int $create_user_id
 *
 * @property TblUser $createUser
 * @property TblMainHeader $header
 * @property TblUser $createUser0
 * @property TblMainHeader $header0
 */
class SubHeader extends \yii\db\ActiveRecord
{

    public function getHeaderOptions()
    {
        return ArrayHelper::map(MainHeader::find()->all(), 'id', 'title');
    }

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_sub_header}}';
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
                    'header_id',
                    'title',
                    'create_user_id'
                ],
                'required'
            ],
            [
                [
                    'header_id',
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
                    'title',
                    'link_url'
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
            ],
            [
                [
                    'header_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => MainHeader::className(),
                'targetAttribute' => [
                    'header_id' => 'id'
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
            'header_id' => Yii::t('app', 'Header ID'),
            'title' => Yii::t('app', 'Title'),
            'link_url' => Yii::t('app', 'Link Url'),
            'state_id' => Yii::t('app', 'State ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
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
    public function getHeader()
    {
        return $this->hasOne(MainHeader::className(), [
            'id' => 'header_id'
        ]);
    }
}
