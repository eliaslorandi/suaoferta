<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "imagem_oferta".
 *
 * @property int $id
 * @property int $oferta_id
 * @property int $arquivo_id
 *
 * @property Arquivo $arquivo
 * @property Oferta $oferta
 */
class ImagemOferta extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagem_oferta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oferta_id', 'arquivo_id'], 'required'],
            [['oferta_id', 'arquivo_id'], 'integer'],
            [['arquivo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Arquivo::class, 'targetAttribute' => ['arquivo_id' => 'id']],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Oferta::class, 'targetAttribute' => ['oferta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oferta_id' => 'Oferta ID',
            'arquivo_id' => 'Arquivo ID',
        ];
    }

    /**
     * Gets query for [[Arquivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArquivo()
    {
        return $this->hasOne(Arquivo::class, ['id' => 'arquivo_id']);
    }

    /**
     * Gets query for [[Oferta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Oferta::class, ['id' => 'oferta_id']);
    }
}
