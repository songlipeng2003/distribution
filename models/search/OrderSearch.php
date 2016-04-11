<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productId', 'quantity', 'status', 'userId'], 'integer'],
            [['price', 'totalAmount'], 'number'],
            [['remark', 'createdAt', 'payedAt', 'updatedAt', 'sn'], 'safe'],
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
        $query = Order::find();

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
            'productId' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'totalAmount' => $this->totalAmount,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'payedAt' => $this->payedAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);
        $query->andFilterWhere(['like', 'sn', $this->sn]);

        return $dataProvider;
    }
}
