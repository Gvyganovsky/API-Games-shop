<?php
namespace app\controllers;

use app\models\Games;
use app\models\Orders;
use app\models\Users;
use Yii;
use yii\rest\Controller;

class OrdersController extends Controller
{
    public $modelClass = 'app\models\Orders';

    public function actionAdd($id_game)
    {
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($user !== null) {
            $game = Games::findOne($id_game);
            if ($game !== null) {
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    $orders = new Orders();
                    $orders->game_id = $game->id_game;
                    $orders->user_id = $user->id_user;
                    $orders->save();

                    $transaction->commit();

                    $response = $this->response;
                    $response->statusCode = 200;
                    $response->data = [
                        'message' => 'Игра куплена',
                    ];
                    return $response;
                } catch (\Exception $err) {
                    $transaction->rollBack();

                    Yii::error('Error buying game: ' . $err->getMessage(), 'app\controllers\OrdersController');

                    $response = $this->response;
                    $response->statusCode = 400;
                    $response->data = [
                        'error' => [
                            'code' => 400,
                            'message' => 'Ошибка при покупке игры: ' . $err->getMessage(),
                        ],
                    ];
                    return $response;
                }
            } else {
                $response = $this->response;
                $response->statusCode = 404;
                $response->data = [
                    'error' => [
                        'code' => 404,
                        'message' => 'Game not found',
                    ],
                ];
                return $response;
            }
        } else {
            $response = $this->response;
            $response->statusCode = 401;
            $response->data = [
                'error' => [
                    'code' => 401,
                    'message' => 'Пользователь не зарегистрирован',
                ],
            ];
            return $response;
        }
    }

    public function actionDelete($order_id)
    {
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($user !== null) {
            $order = Orders::findOne($order_id);
            if ($order !== null) {
                $order->delete();
                $response = $this->response;
                $response->statusCode = 200;
                $response->data = [
                    'message' => 'Игра успешно удалена!',
                ];
                return $response;
            } else {
                $response = $this->response;
                $response->statusCode = 404;
                $response->data = [
                    'error' => [
                        'code' => 404,
                        'message' => 'Order not found',
                    ],
                ];
                return $response;
            }
        } else {
            $response = $this->response;
            $response->statusCode = 401;
            $response->data = [
                'error' => [
                    'code' => 401,
                    'message' => 'Пользователь не зарегистрирован',
                ],
            ];
            return $response;
        }
    }

    private function findUserByToken($token)
    {
        return Users::findOne(['token' => $token]);
    }
}
