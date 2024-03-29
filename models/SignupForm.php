<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{

    public $nomeComercio;
    public $username;
    public $email;
    public $password;
    public $categoriaComercio;

    public function rules()
    {
        return [
            ['nomeComercio', 'trim'],
            ['nomeComercio', 'required'],
            ['nomeComercio', 'string', 'min' => 2, 'max' => 255],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['categoriaComercio', 'trim'],
            ['categoriaComercio', 'required'],
            ['categoriaComercio', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->nomeComercio = $this->nomeComercio;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->categoriaComercio = $this->categoriaComercio;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();
    }
}
