<?php

namespace app\modules\weixin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\weixin\models\WeixinRule;

/**
 * WeixinRuleSearch represents the model behind the search form about `app\modules\weixin\models\WeixinRule`.
 */
class WeixinRuleSearch extends WeixinRule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weixinArticleId'], 'integer'],
            [['keyword', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = WeixinRule::find();

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
            'weixinArticleId' => $this->weixinArticleId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword]);

        return $dataProvider;
    }
}
