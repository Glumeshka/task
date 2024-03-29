<?php

namespace app\models;

use yii\db\ActiveRecord;

class Good extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods';
    }

    public function getGood()
    {
        $goodsList = Yii::$app->db->createCommand('SELECT * FROM post')->queryAll();
        return $goodsList;
    }

    public function actionCreateGoods($arr)
    {
        Yii::$app->db->createCommand()->insert('goods', $arr)->execute();
        return $this->render('goods', ['goodsList' => $this->getGoods()]);
    }

    public function actionReadGoods($id)
    {
        $command = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id')
        ->bindValue(':id', $id)
        ->queryOne();
        return $this->render('goods', ['goodsList' => $command]);
    }

    public function actionUpdateGoods($arr)
    {
        Yii::$app->db->createCommand('UPDATE goods SET user_id = :user_id, name = :name WHERE id = :id')
        ->bindValue(':id', $arr['id'])
        ->bindValue(':user_id', $arr['user_id'])
        ->bindValue(':name', $arr['name'])
        ->execute();
        return $this->render('goods', ['goodsList' => $this->getGoods()]);
    }

    public function actionDeleteGoods($id)
    {
        Yii::$app->db->createCommand()->delete('goods', 'id = :id')
        ->bindValue(':id', $id)
        ->execute();
        return $this->render('goods', ['goodsList' => $this->getGoods()]);
    }

}