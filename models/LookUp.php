<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%look_up}}".
 *
 * @property int $id
 * @property string $type Question Look Up Type
 * @property string $value Look Up Value
 * @property string $name Question Value Name/Label
 * @property int $status Status
 */
class LookUp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%look_up}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'value', 'name', 'status'], 'required'],
            [['status'], 'integer'],
            [['type', 'value'], 'string', 'max' => 25],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Question Look Up Type',
            'value' => 'Look Up Value',
            'name' => 'Question Value Name/Label',
            'status' => 'Status',
        ];
    }
    public static function getLookUpsvalue($type){
        return ArrayHelper::map(self::find()->where(['type' => $type])->andWhere(['status' => 1])->all(), 'value', 'name');
    }
}
