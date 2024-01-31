<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "arquivo".
 *
 * @property int $id
 * @property string $nome
 * @property string $path_url
 * @property string $base_url
 * @property string $mime_type
 *
 * @property ImagemOferta[] $imagemOferta
 */
class Arquivo extends ActiveRecord
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
            [['nome', 'path_url', 'base_url', 'mime_type'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['path_url','base_url', 'mime_type'], 'string', 'max' => 255],
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
            'path_url' => 'Path Url',
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
        return $this->base_url . '/' . $this->nome;
    }

    public function afterDelete()
    {
        parent::afterDelete();
        //deletar do disco
        unlink($this->path_url . '/' . $this->nome);
    }

}
