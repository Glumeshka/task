<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $password2 = null;
    
    public function attributeLabels()
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
            'password2' => 'Повторить пароль'
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'password2'], 'required', 'message' => 'Не может быть пустым!'],
            ['email', 'email', 'message' => 'Не формат почты!'],
            ['password', 'string', 'min' => 4, 'tooShort' => 'Минимум 4 символов'],
            ['password', 'string', 'max' => 8, 'tooLong' => 'Максимум 8 символов'],
            ['password2', 'string', 'min' => 4, 'tooShort' => 'Минимум 4 символов'],
            ['password2', 'string', 'max' => 8, 'tooLong' => 'Максимум 8 символов'],
        ];
    }
}