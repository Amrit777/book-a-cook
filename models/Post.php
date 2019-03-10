<?php
namespace app\models;

use app\components\BaseActiveRecord;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $meta_tag
 * @property string $meta_title
 * @property string $meta_description
 * @property string $slug
 * @property int $is_original_content
 * @property string $created_on
 * @property string $updated_on
 * @property int $state_id
 * @property int $type_id
 * @property int $create_user_id
 *
 * @property User $createUser
 * @property User $createUser0
 * @property PostComment[] $postComments
 * @property PostComment[] $postComments0
 * @property PostLike[] $postLikes
 * @property PostLike[] $postLikes0
 * @property PostShare[] $postShares
 * @property PostShare[] $postShares0
 */
class Post extends BaseActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'slugAttribute' => 'slug'
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{tbl_post}}';
    }

    const IS_ORIGINAL = 1;

    const NOT_ORIGINAL = 0;

    const TYPE_POST = 1;

    const TYPE_QOUTE = 2;

    const TYPE_STORY = 3;

    public function getTypeOptions()
    {
        return [
            self::TYPE_POST => 'Post',
            self::TYPE_QOUTE => 'Qoute',
            self::TYPE_STORY => 'Story'
        ];
    }

    public function getTagsOptions()
    {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'title');
    }

    public function getTags($string = false, $link = false)
    {
        if (! empty($this->tags)) {
            $list = [];
            $tagsArr = explode(',', $this->tags);
            if ($string == true) {
                foreach ($tagsArr as $id) {
                    $tagsModel = Tag::findOne($id);
                    if (! empty($tagsModel)) {
                        $title = '#' . $tagsModel->title;
                        if ($link == true) {
                            $link = Url::toRoute([
                                "post/tags/" . $tagsModel->title
                            ]);
                            $list[] = '<a href="' . $link . '">' . $title . '</a>';
                        } else {
                            $list[] = $title;
                        }
                    }
                }
                return implode(" ", $list);
            } else {
                return $tagsArr;
            }
        }
    }

    public function getType($id = null)
    {
        $list = $this->getTypeOptions();
        if (! empty($id))
            return isset($list[$id]) ? $list[$id] : '(not set)';
        return $list;
    }

    public function getIsOriginalOptions()
    {
        return [
            self::IS_ORIGINAL => 'yes',
            self::NOT_ORIGINAL => 'no'
        ];
    }

    public function getIsOriginal()
    {
        $states = $this->getIsOriginalOptions();
        if ($this->is_original_content == self::IS_ORIGINAL) {
            return '
<span class="label label-success">' . $states[self::IS_ORIGINAL] . '</span>
';
        } else {
            return '
<span class="label label-default">' . $states[self::NOT_ORIGINAL] . '</span>
';
        }
        return "Not Set";
    }

    public function getCategoryIdOptions()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }

    /**
     * * *
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'category_id', // 'create_user_id', 'is_original_content', 'state_id',
                    'content',
                    'meta_tag',
                    'meta_title',
                    'meta_description'
                    // 'slug'
                ],
                'required'
            ],
            [
                [
                    'is_original_content',
                    'state_id',
                    'type_id',
                    'create_user_id',
                    'is_media'
                ],
                'integer'
            ],
            [
                [
                    'created_on',
                    'updated_on',
                    'tags'
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
                    'content',
                    'meta_tag',
                    'meta_title',
                    'meta_description',
                    'slug'
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
     * * * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'category_id' => Yii::t('app', 'Category'),
            'meta_tag' => Yii::t('app', 'Meta Tag'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'is_media' => Yii::t('app', 'Is Media'),
            'slug' => Yii::t('app', 'Slug'),
            'is_original_content' => Yii::t('app', 'Is Original Content'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'state_id' => Yii::t('app', 'State'),
            'type_id' => Yii::t('app', 'Type'),
            'create_user_id' => Yii::t('app', 'Creator')
        ];
    }

    /**
     * * * @return
     * \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getCreateUser0()
    {
        return $this->hasOne(User::className(), [
            'id' => 'create_user_id'
        ]);
    }

    /**
     * *
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), [
            'post_id' => 'id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getPostComments0()
    {
        return $this->hasMany(PostComment::className(), [
            'post_id' => 'id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getPostLikes()
    {
        return $this->hasMany(PostLike::className(), [
            'post_id' => 'id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getPostLikes0()
    {
        return $this->hasMany(PostLike::className(), [
            'post_id' => 'id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getPostShares()
    {
        return $this->hasMany(PostShare::className(), [
            'post_id' => 'id'
        ]);
    }

    /**
     * * * @return \yii\db\ActiveQuery
     */
    public function getPostShares0()
    {
        return $this->hasMany(PostShare::className(), [
            'post_id' => 'id'
        ]);
    }
}
