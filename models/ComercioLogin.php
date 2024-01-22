<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "comercio_login".
 *
 * @property int $id
 * @property string $nomeComercio
 * @property string $senha
 * @property string $email
 * @property int $telefone
 * @property string|null $authKey
 */
class ComercioLogin extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comercio_login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeComercio', 'senha', 'email', 'telefone'], 'required'],
            [['telefone'], 'integer'],
            [['nomeComercio', 'senha', 'email'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 50],
            [['authKey'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomeComercio' => 'Nome Comercio',
            'senha' => 'Senha',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'authKey' => 'Auth Key',
        ];
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id); //checar
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    public static function FindByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($senha)
    {
        return $this->senha === $senha;
    }

}
