<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class NameOne extends ActiveRecord
{
    public $name = 1;

    /**
     * {@inheritdoc}
     */
    public function saveOne()
    {
        
    }
}
