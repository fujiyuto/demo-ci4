<?php

namespace App\Businesses;

use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use DateTime;

class UserBusiness
{
    private UserModel $user_model;
    public $session;

    public function __construct()
    {
        $this->user_model = model(UserModel::class);
        $this->session    = session();
    }

    public function getUser(int|null $id = null): array
    {
        $response_data = [];
        if (!$id) {
            $users = $this->user_model->findAll();
            if (!$users) {
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
            if (!$user) {
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

    public function createUser(string $user_name, string $email, string $password, string $sex): array
    {
        $insert_data = [
            'user_name' => $user_name,
            'email'     => $email,
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'sex'       => $sex
        ];

        if (!$this->user_model->insert($insert_data, false)) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('エラーです');
        }

        return ['ok' => true];
    }

    public function updateUser(int $id, string $user_name, string $sex): array
    {
        $user = $this->user_model->find($id);
        if (!$user) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('エラーです');
        }

        $update_data = [
            'user_name' => $user_name,
            'sex'       => $sex
        ];

        if (!$this->user_model->update($id, $update_data)) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('エラーです');
        }

        return ['ok' => true];
    }

    public function deleteUser(int $id): array
    {
        if (!$this->user_model->delete($id)) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('エラーです');
        }

        return ['ok' => true];
    }

    public function loginUser(string $user_name, string $password): array
    {
        if (!$user = $this->user_model->where('user_name', $user_name)->first()) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('エラーです');
        }

        if (!password_verify($password, $user['password'])) {
            log_message('debug', __CLASS__.'クラスの'.__LINE__.'行目でエラーが出てます。');
            throw new DatabaseException('パスワードが間違ってます');
        }

        // セッションIDの再生成
        $this->session->regenerate();

        // セッションにユーザーデータセット
        $sess_data = [
            'id'        => $user['id'],
            'user_name' => $user['user_name'],
            'email'     => $user['email'],
            'is_auth'   => true
        ];
        $this->session->set($sess_data);

        return ['ok' => true];
    }

    public function logoutUser(): array
    {
        $this->session->destroy();

        return ['ok' => true];
    }

    public function checkAuth(): array
    {
        if ( $this->session->get('is_auth') ) {
            return [
                'id' => $this->session->get('id'),
                'user_name' => $this->session->get('user_name'),
                'email' => $this->session->get('email'),
            ];
        } else {
            return [
                'message' => 'No logged in.'
            ];
        }
    }
}
