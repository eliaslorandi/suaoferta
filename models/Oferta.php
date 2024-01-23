<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oferta".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $descricao
 *
 * @property ImagemOferta[] $imagemOferta
 */
class Oferta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oferta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[ImagemOfertas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemOferta()
    {
        return $this->hasMany(ImagemOferta::class, ['oferta_id' => 'id']);
    }
}
