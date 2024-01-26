<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "arquivo".
 *
 * @property int $id
 * @property string $nome
 * @property string $base_url
 * @property string $mime_type
 *
 * @property ImagemOferta[] $imagemOferta
 */
class Arquivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arquivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'base_url', 'mime_type'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['base_url', 'mime_type'], 'string', 'max' => 255],
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
            'base_url' => 'Base Url',
            'mime_type' => 'Mime Type',
        ];
    }

    /**
     * Gets query for [[ImagemOfertas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemOferta()
    {
        return $this->hasMany(ImagemOferta::class, ['arquivo_id' => 'id']);
    }

    public function absoluteUrl()
    {
        return $this->base_url . '/' . $this->name;
    }
}
