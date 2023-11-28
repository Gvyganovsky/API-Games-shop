<?php
namespace app\controllers;

use app\models\Games;
use app\models\Users;
use Yii;
use yii\rest\Controller;

class GamesController extends Controller
{
    public $modelClass = 'app\models\Games';
    public function actionGames()
    {
        $games = Games::find()->all();
        if ($games !== null) {
            $response = $this->response;
            $response->statusCode = 201;
            $response->data = $games;
        } else {
            $response = $this->response;
            $response->statusCode = 404;
            $response->data = [
                'error' => [
                    'code' => 404,
                    'message' => 'No games found in the system',
                ],
            ];
            return $response;
        }
    }

    public function actionGame($id_game)
    {
        $game = Games::findOne($id_game);
        if ($game !== null) {
            $response = $this->response;
            $response->statusCode = 200;
            $response->data = [
                $game,
            ];
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
    }
    public function actionAdd()
    {
        $data = Yii::$app->request->getBodyParams();
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));

        if ($user !== null && $user->admin !== 0) {
            $game = new Games();
            $game->load($data, ''); // Загружаем данные в модель

            if ($game->validate()) { // Проверяем валидацию
                if ($game->save()) {
                    $response = $this->response;
                    $response->statusCode = 200;
                    $response->data = [$game];
                    return $response;
                } else {
                    // Обработка ошибок при сохранении игры
                    $response = $this->response;
                    $response->statusCode = 400;
                    $response->data = [
                        'error' => [
                            'code' => 400,
                            'message' => 'Ошибка сохранения игры',
                            'errors' => $game->getErrors(),
                        ],
                    ];
                    return $response;
                }
            } else {
                // Ошибка валидации данных
                $response = $this->response;
                $response->statusCode = 422;
                $response->data = [
                    'error' => [
                        'code' => 422,
                        'message' => 'Ошибка валидации данных для создания игры',
                        'errors' => $game->getErrors(),
                    ],
                ];
                return $response;
            }
        } else {
            // Ошибка отсутствия прав администратора
            $response = $this->response;
            $response->statusCode = 401;
            $response->data = [
                'error' => [
                    'code' => 401,
                    'message' => 'Отсутствуют права администратора',
                ],
            ];
            return $response;
        }
    }

    public function actionDelete($id_game)
    {
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($user !== null && $user->admin !== 0) {
            $game = Games::findOne($id_game);
            if ($game !== null) {
                $game->delete();
                $response = $this->response;
                $response->statusCode = 201;
                $response->data = [
                    'error' => [
                        'code' => 201,
                        'message' => 'Игра успешно удалена!',
                    ],
                ];
                return $response;
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
                    'message' => 'Отсутствуют права администратора',
                ],
            ];
        }
    }

    public function actionUpdate($id_game)
    {
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($user !== null && $user->admin !== 0) {
            $game = Games::findOne($id_game);
            if ($game !== null) {
                ;
                $game->load(Yii::$app->request->post(), '');
                $game->save();

                $response = $this->response;
                $response->statusCode = 404;
                $response->data = [
                    'error' => [
                        'code' => 201,
                        'message' => 'Игра успешно изменена!',
                    ],
                ];
                return $response;
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
                    'message' => 'Отсутствуют права администратора',
                ],
            ];
        }
    }

    private function findUserByToken($token)
    {
        return Users::findOne(['token' => $token]);
    }
}