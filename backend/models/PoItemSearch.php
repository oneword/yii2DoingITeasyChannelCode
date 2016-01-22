<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PoItem;

/**
 * PoItemSearch represents the model behind the search form about `backend\models\PoItem`.
 */
class PoItemSearch extends PoItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'po_id'], 'integer'],
            [['po_item_no'], 'safe'],
            [['quantity'], 'number'],
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
        $query = PoItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'po_id' => $this->po_id,
        ]);

        $query->andFilterWhere(['like', 'po_item_no', $this->po_item_no]);

        return $dataProvider;
    }
}
