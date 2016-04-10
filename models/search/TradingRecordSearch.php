<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TradingRecord;

/**
 * TradingRecordSearch represents the model behind the search form about `app\models\TradingRecord`.
 */
class TradingRecordSearch extends TradingRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'userType', 'tradingType', 'itemId'], 'integer'],
            [['sn', 'name', 'amount', 'itemType', 'remark', 'createdAt'], 'safe'],
            [['startAmount', 'endAmount'], 'number'],
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
        $query = TradingRecord::find();

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
            'userId' => $this->userId,
            'userType' => $this->userType,
            'tradingType' => $this->tradingType,
            'startAmount' => $this->startAmount,
            'endAmount' => $this->endAmount,
            'itemId' => $this->itemId,
            'createdAt' => $this->createdAt,
        ]);

        $query->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'itemType', $this->itemType])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
