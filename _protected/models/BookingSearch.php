<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Booking;

/**
 * app\models\BookingSearch represents the model behind the search form about `app\models\Booking`.
 */
 class BookingSearch extends Booking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'no_meja', 'user_id', 'starttime', 'endtime'], 'integer'],
            [['is_available'], 'safe'],
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
        $query = Booking::find();

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
            'no_meja' => $this->no_meja,
            'user_id' => $this->user_id,
            'starttime' => $this->starttime,
            'endtime' => $this->endtime,
        ]);

        $query->andFilterWhere(['like', 'is_available', $this->is_available]);

        return $dataProvider;
    }
}
