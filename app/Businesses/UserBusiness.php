<?php

namespace App\Businesses;

use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use DateTime;

class UserBusiness {
    private UserModel $user_model;

    public function __construct()
    {
        $this->user_model = model(UserModel::class);
    }

    public function getUser(int|null $id = null)
    {
        $response_data = [];
        if ( !$id ) {
            $users = $this->user_model->findAll();
            if ( !$users ) {
                log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
                throw new DatabaseException('エラーです');
            }
            foreach ($users as $user) {
                $datetime = new DateTime($user['created_at']);
                $date     = $datetime->format('Y年m月d日');
                $response_data[] = [
                    'id'         => $user['id'],
                    'user_name'  => $user['user_name'],
                    'created_at' => $date
                ];
            }
            return $response_data;
        } else {

            $user = $this->user_model->find($id);
            if ( !$user ) {
                log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
                throw new DatabaseException('エラーです');
            }

            $created_datetime = new DateTime($user['created_at']);
            $created_date     = $created_datetime->format('Y年m月d日');
            $updated_datetime = new DateTime($user['updated_at']);
            $updated_date     = $updated_datetime->format('Y年m月d日');

            $response_data = [
                'id'         => $user['id'],
                'user_name'  => $user['user_name'],
                'email'      => $user['email'],
                'sex'        => $user['sex'],
                'created_at' => $created_date,
                'updated_at' => $updated_date
            ];
            return $response_data;
        }
    }
}
