<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSeacrh represents the model behind the search form of `app\models\Request`.
 */
class RequestSeacrh extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_project', 'primary_contact', 'fk_user'], 'integer'],
            [['data_variables', 'data_crfs', 'data_sites', 'variable_justification', 'date_from', 'date_to', 'date_received', 'date_created', 'date_modified'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Request::find();

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
            'fk_project' => $this->fk_project,
            'primary_contact' => $this->primary_contact,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'date_received' => $this->date_received,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
            'fk_user' => $this->fk_user,
        ]);

        $query->andFilterWhere(['like', 'data_variables', $this->data_variables])
            ->andFilterWhere(['like', 'data_crfs', $this->data_crfs])
            ->andFilterWhere(['like', 'data_sites', $this->data_sites])
            ->andFilterWhere(['like', 'variable_justification', $this->variable_justification]);

        return $dataProvider;
    }
}
