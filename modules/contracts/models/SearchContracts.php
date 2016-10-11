<?php

namespace app\modules\contracts\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contracts\models\Contracts;

/**
 * SearchContracts represents the model behind the search form about `app\modules\contracts\models\Contracts`.
 */
class SearchContracts extends Contracts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sum'], 'integer'],
            [['date', 'name', 'passport', 'phone', 'manufacturer', 'model', 'imei', 'percent', 'sale_point'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Contracts::find();

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
            'date' => $this->date,
            'price' => $this->price,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'percent', $this->percent])
            ->andFilterWhere(['like', 'sale_point', $this->sale_point]);

        return $dataProvider;
    }
}
