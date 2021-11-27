<?php

namespace app\search;

use Carbon\Carbon;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;
use yii\db\ActiveQuery;

/**
 * ProjectSeacrh represents the model behind the search form of `app\models\Project`.
 */
class ProjectSeacrh extends Project
{
    public $date_created_start;
    public $date_created_end;
    /**
     * @var mixed|string|null
     */
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'primary_contact', 'fk_user'], 'integer'],
            [['date_created_start', 'date_created_end','project_name', 'project_aim', 'data_type', 'proposal_type', 'irb_approved', 'irb_approvers', 'statistical_file', 'milestones', 'date_created', 'date_modified'], 'safe'],
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
        $query = Project::find();

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
            'primary_contact' => $this->primary_contact,
            'fk_user' => $this->fk_user,
            'date_modified' => $this->date_modified,
        ]);

        if ($this->date_created_start && $this->date_created_end) {
            $query->andWhere(['between', 'date_created', $this->date_created_start, $this->date_created_end]);
        }
        $this->date_created_start = null;
        $this->date_created_end = null;

        if($this->status){
            if($this->status === 'archive'){
                $query->joinWith(['fkRequests' => function (ActiveQuery $query) {
                    return $query
                        ->andWhere(['in', 'data_requests.status', [4, 5]])
                        ->andWhere(['<', 'data_requests.date_created', Carbon::today()->subMonths(3)]);
                }]);
            }else{
                $query->joinWith(['fkRequests' => function (ActiveQuery $query) {
                    return $query
                        ->andWhere(['=', 'data_requests.status', $this->status]);
                }]);
            }
        }

        $query->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'project_aim', $this->project_aim])
            ->andFilterWhere(['like', 'data_type', $this->data_type])
            ->andFilterWhere(['like', 'proposal_type', $this->proposal_type])
            ->andFilterWhere(['like', 'irb_approved', $this->irb_approved])
            ->andFilterWhere(['like', 'irb_approvers', $this->irb_approvers])
            ->andFilterWhere(['like', 'statistical_file', $this->statistical_file])
            ->andFilterWhere(['like', 'milestones', $this->milestones]);

        return $dataProvider;
    }
}
