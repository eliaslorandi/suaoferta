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
     * @var UploadedFile
     */
    public $arquivoImagem;

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
            [['arquivoImagem'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
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

    public function saveImagem()
    {

        Yii::$app->db->transaction(function ($db) {

            /**
             * @var $db \yii\db\Connection
             */

            $arquivo = new Arquivo();
            $arquivo->nome = uniqid(true) . '.' . $this->arquivoImagem->extension;
            $arquivo->base_url = Yii::$app->urlManager->createAbsoluteUrl('uploads/ofertas');
            $arquivo->mime_content_type($this->arquivoImagem->tempName);
            $arquivo->save();

            // Salva o arquivo
            $arquivo = new arquivo();
            $arquivo->oferta_id = $this->id;
            $arquivo->arquivo_id = $arquivo->id;
            $arquivo->save();

            if (!$this->arquivoImagem->saveAs(Yii::$app->params['uploads']['ofertas'] . '/' . $arquivo->nome)) {
                $db->transaction->rollBack();
            }
        });
    }
}
