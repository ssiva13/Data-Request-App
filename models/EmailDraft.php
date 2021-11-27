<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%email_drafts}}".
 *
 * @property int $id
 * @property string $type Draft Type
 * @property string $subject Email Subject
 * @property string $body Email Body
 * @property int $status Request Status
 */
class EmailDraft extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_drafts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['status'], 'integer'],
            [['type'], 'string', 'max' => 25],
            [['subject'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Draft Type',
            'subject' => 'Email Subject',
            'body' => 'Email Body',
            'status' => 'Draft Status',
        ];
    }
}
