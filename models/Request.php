<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%requests}}".
 *
 * @property int $id ID
 * @property int $fk_project Project Name
 * @property int $primary_contact Primary Contact Name
 * @property string|null $data_variables Data Variables
 * @property string|null $data_crfs Data CRFs Used
 * @property string|null $data_sites Data Sites
 * @property string|null $variable_justification Data Variables Justifications
 * @property string|null $date_from Date From
 * @property string|null $date_to Date To
 * @property string|null $date_received Date Recieved
 * @property string $date_created Date Created
 * @property string|null $date_modified Date Modified
 * @property int $fk_user User ID
 *
 * @property Project $fkProject
 * @property User $primaryContact
 * @property User $fkUser
 * @property mixed|null status
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%requests}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_project', 'primary_contact', 'fk_user'], 'required'],
            [['fk_project', 'primary_contact', 'fk_user', 'status'], 'integer'],
            [['data_variables', 'data_crfs', 'variable_justification', 'review_notes'], 'string'],
            [['date_from', 'date_to', 'date_received', 'date_created', 'date_modified'], 'safe'],
            [['data_sites'], 'string', 'max' => 200],
            [['fk_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['fk_project' => 'id']],
            [['primary_contact'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['primary_contact' => 'id']],
            [['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_project' => 'Project Name',
            'primary_contact' => 'Primary Contact Name',
            'data_variables' => 'Data Variables',
            'data_crfs' => 'Data CRFs Used',
            'data_sites' => 'Data Sites',
            'variable_justification' => 'Data Variables Justifications',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'date_received' => 'Date Recieved',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'fk_user' => 'User ID',
            'status' => 'Request Status',
            'review_notes' => 'Review Notes',
        ];
    }

    /**
     * Gets query for [[FkProject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'fk_project']);
    }

    /**
     * Gets query for [[PrimaryContact]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryContact()
    {
        return $this->hasOne(User::className(), ['id' => 'primary_contact']);
    }

    /**
     * Gets query for [[FkUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_user']);
    }

    public function beforeValidate()
    {
        $this->fk_user = Yii::$app->user->identity->id;
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }
    public function beforeSave($insert)
    {
        $this->data_sites = Json::encode($this->data_sites);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        $this->data_sites = Json::decode($this->data_sites);
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        switch ($this->status){
            case 1:
                //review
                EmailMessage::sendMail('submitted', $this);
                break;
            case 2:
                //resubmit
                EmailMessage::sendMail('resubmit', $this);
                break;
            case 3:
                //pending
                EmailMessage::sendMail('reviewed', $this);
                break;
            case 4:
                //approved
                EmailMessage::sendMail('approval', $this);
                break;
            case 5:
                //declined
                EmailMessage::sendMail('declined', $this);
                break;

        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
