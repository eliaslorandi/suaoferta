<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

class OfertaQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Oferta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /*
    * {@inheritdoc}
    * @return Oferta|array|null
    */

    public function one($db = null)
    {
        return parent::one($db);
    }
}
