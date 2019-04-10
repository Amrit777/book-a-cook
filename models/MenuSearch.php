<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Menu;

/**
 * MenuSearch represents the model behind the search form of `app\models\Menu`.
 */
class MenuSearch extends Menu {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'id',
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
								'title',
								'content',
								'created_on',
								'updated_on' 
						],
						'safe' 
				] 
		];
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios ();
	}
	
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params        	
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Menu::find ();
		if (User::isCook ()) {
			$query->where ( [ 
					'create_user_id' => \Yii::$app->user->id 
			] );
		}
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		$this->load ( $params );
		
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'category_id' => $this->category_id,
				'price' => $this->price,
				'time_to_prepare' => $this->time_to_prepare,
				'created_on' => $this->created_on,
				'updated_on' => $this->updated_on,
				'state_id' => $this->state_id,
				'type_id' => $this->type_id,
				'create_user_id' => $this->create_user_id 
		] );
		
		$query->andFilterWhere ( [ 
				'like',
				'title',
				$this->title 
		] )->andFilterWhere ( [ 
				'like',
				'content',
				$this->content 
		] );
		
		return $dataProvider;
	}
}
