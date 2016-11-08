<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * SearchUser represents the model behind the search form about `app\models\User`.
 */
class SearchUser extends User
{
    public $statusText;
    public $roleText;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'auth_key', 'password_hash'], 'safe'],
            [['statusText', 'roleText'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['roleText'] = 
            [
            'asc' => ['role' => SORT_ASC],
            'desc' => ['role' => SORT_DESC],
            'label' => 'Role',
            'default' => SORT_ASC,
            ];
        $dataProvider->sort->attributes['statusText'] = 
            [
            'asc' => ['status' => SORT_ASC],
            'desc' => ['status' => SORT_DESC],
            'label' => 'Active',
            'default' => SORT_ASC,
            ];

        //$this->load($params);
        if (!($this->load($params) && $this-validate())) {
            return $dataProvider;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash]);


        return $dataProvider;
    }
}
