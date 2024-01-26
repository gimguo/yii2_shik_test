<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Order;

/**
 * OrderSearch represents the model behind the search form of `frontend\models\Order`.
 *
 * @property string $fromDate
 * @property string $toDate
 *
 */
class OrderSearch extends Order
{
    public $fromDate;
    public $toDate;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sum'], 'number'],
            [['created_at', 'fromDate', 'toDate'], 'safe'],
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
        $query = Order::find();

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
            'sum' => $this->sum,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['between', 'created_at', $this->fromDate, $this->toDate ]);

        return $dataProvider;
    }
}
