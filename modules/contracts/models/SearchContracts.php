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
    public $salePoint;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sum'], 'integer'],
            [['date', 'name', 'passport', 'phone', 'manufacturer', 'model', 'imei', 'percent', 'user'], 'safe'],
            [['price'], 'number'],
            [['salePoint'], 'safe'],
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
        //$query = Contracts::find()->with('user');
        $query = Contracts::find();


        // add conditions that should always apply here
        //$query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['salePoint'] = 
            [
            'asc' => ['mg_user.display_name' => SORT_ASC],
            'desc' => ['mg_user.display_name' => SORT_DESC],
            'label' => 'Sale point',
            'default' => SORT_ASC,
            ];

        if (!($this->load($params) &&  $this->validate())) {
            /**
             * Жадная загрузка данных модели User
             * для работы сортировки.
             */
            $query->joinWith(['user']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'price' => $this->price,
            'sum' => $this->sum,
           // 'user' => $this->user,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'percent', $this->percent])
            //->andFilterWhere(['like', 'mb_user.display_name', $this->salePoint])
            ;
            // Фильтр по User
        $query->joinWith(['user' => function ($q) {
            $q->where('mg_user.display_name LIKE "%' . $this->salePoint . '%"');
        }]);

        return $dataProvider;
    }

    // написано здесь  - пример работает
    //https://nix-tips.ru/yii2-sortirovka-i-filtr-gridview-po-svyazannym-i-vychislyaemym-polyam.html
    //
}
