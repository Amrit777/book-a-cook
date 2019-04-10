<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BookMenu;

/**
 * BookMenuSearch represents the model behind the search form of `app\models\BookMenu`.
 */
class BookMenuSearch extends BookMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'number_of_person', 'state_id', 'type_id', 'create_user_id'], 'integer'],
            [['booking_date', 'booking_time', 'updated_on'], 'safe'],
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
        $query = BookMenu::find();

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
            'menu_id' => $this->menu_id,
            'booking_date' => $this->booking_date,
            'booking_time' => $this->booking_time,
            'number_of_person' => $this->number_of_person,
            'updated_on' => $this->updated_on,
            'state_id' => $this->state_id,
            'type_id' => $this->type_id,
            'create_user_id' => $this->create_user_id,
        ]);

        return $dataProvider;
    }
}
