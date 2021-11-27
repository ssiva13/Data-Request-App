<?php


namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use app\models\User;

class ChangePasswordForm extends \yii\base\Model
{
    public $confirm_password;
    public $password;
    public $id;
    private $_pass = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // confirm_password and password are both required
            [['confirm_password', 'password'], 'required'],
            // password is validated by validatePasswordMatch()
            ['password', 'validatePasswordMatch'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
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
            }

        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @param $id
     * @return bool whether the user is logged in successfully
     * @throws Exception
     */
    public function change($id)
    {
        if ($this->validate()) {
            return User::changePassword($this->getUser($id), $this->password);
        }
        return false;
    }

    /**
     * Finds user by [[id]]
     *
     * @return User|null
     */
    public function getUser($id)
    {
        if ($this->_user === false) {
            $this->_user = User::findIdentity($id);
        }

        return $this->_user;
    }
}