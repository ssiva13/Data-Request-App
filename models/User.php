<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * @property-read mixed $id
 * @property-read mixed $authKey
 * @property mixed|null password
 * @property mixed|string|null auth_key
 * @property mixed|null first_name
 * @property mixed|null last_name
 * @property mixed|null email
 * @property mixed|null phone
 * @property mixed|null date_created
 * @property mixed|null date_modified
 */
class User extends ActiveRecord implements IdentityInterface
{

    public $confirm_password;
    /**
     * @var mixed|null
     */
    public $clearPass;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'password', 'confirm_password', 'username'], 'required'],
            [['phone'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 20],
            [['email'], 'email', 'message' => 'Please provide a valid email address'],
            [['username'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
            [['password', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique', 'message' => 'This email has already been taken'],
            [['username'], 'unique', 'message' => 'This username has already been taken'],
            ['password', 'validatePasswordMatch'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'email' => 'User Email',
            'phone' => 'Phone Number',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'auth_key' => 'Auth Key',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePasswordMatch($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $pass = $this->password === $this->confirm_password;
            if (!$pass) {
                $this->addError('password', 'Passwords Do Not Match');
                $this->addError('confirm_password', 'Passwords Do Not Match');
            }
        }
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * Finds user by username
     *
     * @param $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /** @inheritdoc */
    public function getId() {
        return $this->getAttribute('id');
    }
    /**
     * process password change
     * @param $user
     * @param $password
     * @return bool
     * @throws Exception
     */
    public static function changePassword($user, $password){
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->confirm_password = $user->password;
        if($user->save()){
            return true;
        }
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $hash = $this->password;
        return Yii::$app->getSecurity()->validatePassword($password, $hash);
    }

    /**
     * @param $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->clearPass = $this->password;
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
        return parent::beforeSave($insert);
    }

    public function getAuthKey()
    {
        return $this->getAttribute('auth_key');
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function getUserList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', function ($row){ return $row['first_name']. ' '.$row['last_name'];});
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            EmailMessage::sendMail('registration', $this);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
