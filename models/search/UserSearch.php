<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parentId', 'level1Number', 'level2Number', 'level3Number', 'employeeId', 'monthLimit', 'userType'], 'integer'],
            [['username', 'password', 'weixin', 'avatar', 'token', 'createdAt', 'updatedAt', 'lastLoginedAt'], 'safe'],
            [['thisMonthIncome', 'totalIncome'], 'number'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parentId' => $this->parentId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'lastLoginedAt' => $this->lastLoginedAt,
            'level1Number' => $this->level1Number,
            'level2Number' => $this->level2Number,
            'level3Number' => $this->level3Number,
            'employeeId' => $this->employeeId,
            'monthLimit' => $this->monthLimit,
            'thisMonthIncome' => $this->thisMonthIncome,
            'totalIncome' => $this->totalIncome,
            'userType' => $this->userType,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'weixin', $this->weixin])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
