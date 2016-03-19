<?php

namespace app\modules\weixin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\weixin\models\WeixinUser;

/**
 * WeixinUserSearch represents the model behind the search form about `app\modules\weixin\models\WeixinUser`.
 */
class WeixinUserSearch extends WeixinUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['openid', 'username', 'nickname', 'city', 'avatar', 'language', 'province', 'country', 'remark', 'groupId', 'subscribeTime', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = WeixinUser::find();

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
            'subscribeTime' => $this->subscribeTime,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ]);

        $query->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'groupId', $this->groupId]);

        return $dataProvider;
    }
}
