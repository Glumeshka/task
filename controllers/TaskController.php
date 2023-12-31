<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\SingupForm;
use app\models\LoginForm;

class TaskController extends Controller
{
    public $layout = 'task';
     
    public function actionIndex()
    {
        $this->view->title = 'Вход в систему';

        // $this->view->registerMetaTag([
        //     'name' => 'keywords',
        //     'content' => 'ключевики..'
        // ]);
        // $this->view->registerMetaTag([
        //     'name' => 'description',
        //     'content' => 'описание..'
        // ]);
        
        $modelLogin = new LoginForm();
        $modelSing = new SingupForm();

        
        if ($modelLogin->load(Yii::$app->request->post())) {
            if ($modelLogin->validate()) {
                debug($modelLogin);
            } else {

            }
            
        }

        if ($modelSing->load(Yii::$app->request->post())) {
            if ($modelSing->validate()) {
                debug($modelSing);
            } else {

            }
            
        }

        return $this->render("index", compact('modelLogin', 'modelSing'));
    }

    public function actionSignup()
    {
        return $this->render("signup");
    }

    public function actionLogin()
    {
        return $this->render("login");
    }

    public function actionGoods()
    {
        return $this->render("goods");
    }

    public function getGoods()
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

    public function actionLogout()
    {

    }
}