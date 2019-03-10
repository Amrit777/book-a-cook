<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PostShare;

/**
 * PostShareSearch represents the model behind the search form of `app\models\PostShare`.
 */
class PostShareSearch extends PostShare
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'state_id', 'type_id', 'create_user_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PostShare::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $this->post_id,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
            'state_id' => $this->state_id,
            'type_id' => $this->type_id,
            'create_user_id' => $this->create_user_id,
        ]);

        return $dataProvider;
    }
}