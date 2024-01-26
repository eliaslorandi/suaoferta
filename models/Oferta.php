<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

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
            [['arquivoImagem'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            'descricao' => 'Descrição',
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

    public function saveImagem()//4 etapas: criar um registo na tabela file, criar um registo na tabela project_image com id, 
    {                           //salvar a imagem no disco, agrupar estas 3 etapas numa transação

        Yii::$app->db->transaction(function ($db) {

            /**
             * @var $db \yii\db\Connection
             */

            $arquivo = new Arquivo();
            $arquivo->nome = uniqid(true) . '.' . $this->arquivoImagem->extension;
            $arquivo->base_url = Yii::$app->urlManager->createAbsoluteUrl(Yii::$app->params['uploads']['ofertas']);
            $arquivo->mime_type = FileHelper::getMimeType($this->arquivoImagem->tempName);
            $arquivo->save();

            // criar registro de imagem do projeto na tabela imagem_oferta
            $imagemOferta = new ImagemOferta();
            $imagemOferta->oferta_id = $this->id;
            $imagemOferta->arquivo_id = $arquivo->id;
            $imagemOferta->save();

            //if para caso der erro no upload da imagem
            if (!$this->arquivoImagem->saveAs(Yii::$app->params['uploads']['ofertas'] . '/' . $arquivo->nome)) {
                $db->transaction->rollBack();
            }
        });
    }
}
