<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\User;
use app\models\Good;
use yii\db\ActiveRecord;

class TaskController extends Controller
{
    public $layout;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Вход в систему';
        // переопределение шаблона для страницы авторизации
        $this->layout = 'task';
        
        $modelLogin = new LoginForm();
        $modelSign = new SignupForm();
        $modelUser = new User();
        // $modelGood = new Good();
        
        // логин пользователя
        if ($modelLogin->load(Yii::$app->request->post())) {
            // отсечение не верного логина по почте
            if (!$this->getUser($modelLogin->email)) {
                Yii::$app->session->setFlash('message','Пользователь не найден!');
                return $this->refresh();
            }
            // выдергиваем хеш пароля для сравнения
            $user = User::find()->where(['email' => $modelLogin->email])->one();
            $hash = $user->password;
            // проверка пароля
            if (Yii::$app->getSecurity()->validatePassword($modelLogin->password, $hash)) {
            // вставить сессию юзера для пинка со страницы с продуктами
            // регистрировать средствами yii и перенаправить на защиненную страницу
                Yii::$app->session->setFlash('message','пароль верный!');
            // return $this->goGoods();                
            } else {
                Yii::$app->session->setFlash('message','пароль не верный!');
            }
        }       

        // регистрация нового пользователя
        if ($modelSign->load(Yii::$app->request->post())) {
            //проверка совпадения паролей на сервере
            if ($modelSign->password != $modelSign->password2) {
                Yii::$app->session->setFlash('message','Пароли не совпадают!');
            //проверка на успешную регистрацию
            } elseif ($modelSign->validate() && $modelSign->password === $modelSign->password2) {
                // проверка на наличие текущего пользователя в Базе
                if ($this->getUser($modelSign->email)) {
                    Yii::$app->session->setFlash('message','Такой пользователь уже есть!');
                    return $this->refresh();
                }
                // отправка письма на почту об успешной регистрации
                if($this->sendMail($modelSign->email)){
                    $modelUser->email = $modelSign->email;
                    $modelUser->password = Yii::$app->getSecurity()->generatePasswordHash($modelSign->password);
                    $modelUser->created = date("Y-m-d H:i:s");
                    $modelUser->save();               
                    return $this->refresh();
                } else {
                    return $this->refresh();
                }

            } else {
                // затычка на непредвиденные обстаятельства
                Yii::$app->session->setFlash('message','Что то пошло не так!');
                return $this->refresh();
            }            
        }

        return $this->render("index", compact('modelLogin', 'modelSign'));
    }

    public function sendMail($email)
    {
        try {
            Yii::$app->mailer->compose()
            ->setFrom('RZL1985@yandex.ru')
            ->setTo($email)
            ->setSubject('Письмо с локал хоста')
            ->setTextBody('Поздравляю с успешной регистрацией!')
            ->send();
            Yii::$app->session->setFlash('message','Письмо отправлено на почту!');
            return true;
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('message', $e);
            return false;
        }
    }

    protected function getUser($email)
    {
        $user = User::find()->where(['email' => $email])->count();
        if ($user > 0) {
            return true;
        }
        return false;
    }

    public function actionGoods()
    {
        // пинок со стораницы если если нет записи в сессию // из темы авторизации
        $this->view->title = 'Список товаров';
        $this->layout = 'back';
        $goods = Good::find()->indexBy('id')->all();
        return $this->render("goods", compact('goods'));         
    }

    public function actionAddGoods()
    {
        // пинок со стораницы если если нет записи в сессию // из темы авторизации
        $this->view->title = 'Добавить товар';
        $this->layout = 'back';
        $goods = Good::find()->indexBy('id')->all();
        return $this->render("addgoods", compact('goods'));         
    }
    public function actionLogout()
    {
        // короткий дестрой сессии, по средствам yii2
    }
}