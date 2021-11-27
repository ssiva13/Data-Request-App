<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%email_messages}}".
 *
 * @property int $id
 * @property string $fk_request Draft Number
 * @property string $subject Email Subject
 * @property string $body Email Body
 * @property string $from Sent From
 * @property string $to Sent to
 * @property string $date_sent Date Sent
 */
class EmailMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_messages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'body', 'from', 'to', 'date_sent'], 'required'],
            [['body'], 'string'],
            [['date_sent'], 'safe'],
            [['fk_request'], 'integer'],
            [['subject', 'from', 'to'], 'string', 'max' => 50],
            [['fk_request'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['fk_request' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_request' => 'Request Number',
            'subject' => 'Email Subject',
            'body' => 'Email Body',
            'from' => 'Sent From',
            'to' => 'Sent to',
            'date_sent' => 'Date Sent',
        ];
    }

    /**
     * Gets query for [[FkRequest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkRequest()
    {
        return $this->hasOne(Project::className(), ['id' => 'fk_request']);
    }

    public static function sendMail($type, $user){
        $draft = EmailDraft::findOne(['type' => $type]);
        $name = ($userDetails = User::findByEmail($user->email)) ? $userDetails->first_name . ' ' . $userDetails->last_name : $user->name;
        $draft->body = str_replace('%sender%', Yii::$app->params['senderName'], $draft->body);
        $draft->body = str_replace('%user%', $name, $draft->body);
        $project = null;
        if($type !== 'registration'){
            $draft->body = str_replace('%project%', $user->fkRequest->project_name, $draft->body);
            $draft->subject = str_replace('%project%', $user->fkRequest->project_name, $draft->subject);
            $project = $user->fkRequest->id;
        }
        if($type === 'registration'){
            $draft->body = str_replace('%username%', $user->username, $draft->body);
            $draft->body = str_replace('%email%', $user->email, $draft->body);
            $draft->body = str_replace('%password%', $user->clearPass, $draft->body);
        }

        $sent = Yii::$app->mailer->compose()
            ->setTo($user->email)
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setCc(Yii::$app->params['adminEmail'])
            ->setSubject($draft->subject)
            ->setTextBody($draft->body)
            ->send();
        if($sent){
            $mail = new EmailMessage();
            $mail->body = $draft->body;
            $mail->fk_request = $project;
            $mail->subject = $draft->subject;
            $mail->to = $user->email;
            $mail->from = Yii::$app->params['senderEmail'];
            $mail->date_sent = Carbon::today();
            if($mail->save()){
                return true;
            }
            return $mail->errors;
        }
        return false;
    }
}
