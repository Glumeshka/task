<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends ActiveRecord
{
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль'
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required', 'message' => 'Не может быть пустым!'],
            ['email', 'email', 'message' => 'Не формат почты!'],
            ['password', 'string', 'min' => 4, 'tooShort' => 'Минимум 4 символов'],
            ['password', 'string', 'max' => 8, 'tooLong' => 'Максимум 8 символов'],
        ];
    }
}
