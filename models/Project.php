<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property int $id ID
 * @property string $project_name Project Name
 * @property int $primary_contact Primary Contact
 * @property string $project_aim Project Aim
 * @property string|null $data_type Type of Data Options
 * @property string|null $proposal_type Type of Proposal Options
 * @property string|null $irb_approved Approved by IRB (yes or no)
 * @property string|null $irb_approvers IRB Approvers Options
 * @property string|null $statistical_file Statistical File Name
 * @property string|null $target_date Target Completion Date
 * @property string|null $milestones Project Milestones
 * @property int $fk_user User ID
 * @property string $date_created Date Created
 * @property string $date_modified Date Modified
 *
 * @property User $fkUser
 * @property-read ActiveQuery $fkRequests
 * @property User $primaryContact
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name', 'primary_contact', 'project_aim', 'fk_user'], 'required'],
            [['primary_contact', 'fk_user'], 'integer'],
            [['target_date', 'date_created', 'date_modified', 'data_type', 'irb_approvers', 'irb_approved'], 'safe'],
            [['project_name'], 'string', 'max' => 75],
            [['project_aim', 'milestones'], 'string'],
            [['proposal_type'], 'string', 'max' => 30],
            [['statistical_file'], 'string', 'max' => 255],
            [['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_user' => 'id']],
            [['primary_contact'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['primary_contact' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'primary_contact' => 'Primary Contact',
            'project_aim' => 'Project Aim',
            'data_type' => 'Type of Data',
            'proposal_type' => 'Type of Proposal',
            'irb_approved' => 'Approved by IRB (yes or no)',
            'irb_approvers' => 'IRB Approvers',
            'statistical_file' => 'Statistical File Name',
            'target_date' => 'Target Completion Date',
            'milestones' => 'Project Milestones',
            'fk_user' => 'User ID',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * Gets query for [[FkUser]].
     *
     * @return ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_user']);
    }

    /**
     * Gets query for [[PrimaryContact]].
     *
     * @return ActiveQuery
     */
    public function getPrimaryContact()
    {
        return $this->hasOne(User::className(), ['id' => 'primary_contact']);
    }

    /**
     * Gets query for [[FkProject]].
     *
     * @return ActiveQuery
     */
    public function getFkRequests()
    {
        return $this->hasMany(Request::className(), ['fk_project' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->irb_approvers = Json::encode($this->irb_approvers);
        $this->data_type = Json::encode($this->data_type);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        $this->irb_approvers = Json::decode($this->irb_approvers);
        $this->data_type = Json::decode($this->data_type);
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public static function getProjectList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'project_name');
    }

    public static function getUserProjectList()
    {
        return ArrayHelper::map(self::find()->where(['fk_user' => Yii::$app->user->identity->id])->all(), 'id', 'project_name');
    }

    public function statusBadges($status){
        switch ($status){
            case 1:
                //review
                return 'primary';
            case 2:
                //resubmit
                return 'warning';
            case 3:
                //pending
                return 'info';
            case 4:
                //approved
                return 'success';
            case 5:
                //declined
                return 'danger';
            default:
                //null
                return 'default';
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            EmailMessage::sendMail('submitted', $this);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

}
