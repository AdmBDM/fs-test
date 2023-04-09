<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use common\models\Visit;

/**
 * VisitSearch represents the model behind the search form of `common\models\Visit`.
 */
class VisitSearch extends Visit
{
	public $manager;
	public $visiter;

	/**
	 * @return array[]
	 */
    public function rules(): array
    {
        return [
            [['client_id', 'staff_id',], 'integer'],
            [['visit_date'], 'safe'],
            [['visit_sum'], 'number'],
            [['manager', 'visiter', ], 'safe'],
        ];
    }

	/**
	 * @return array|array[]
	 */
    public function scenarios(): array
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
    public function search($params): ActiveDataProvider
	{
        $query = Visit::find();

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
            'client_id' => $this->client_id,
            'staff_id' => $this->staff_id,
            'visit_date' => $this->visit_date,
            'visit_sum' => $this->visit_sum,
        ]);

        return $dataProvider;
    }
}
