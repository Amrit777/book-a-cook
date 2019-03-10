<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_tag}}".
 *
 * @property int $id
 * @property string $title
 */
class Tag extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_tag}}';
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
                    'title'
                ],
                'required'
            ],
            [
                [
                    'title'
                ],
                'string',
                'max' => 127
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
            'title' => Yii::t('app', 'Title')
        ];
    }
}
