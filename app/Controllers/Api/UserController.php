<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Businesses\UserBusiness;
use CodeIgniter\API\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    private UserBusiness $user_business;

    public function __construct()
    {
        $this->user_business = new UserBusiness();
    }

    public function index()
    {
        try {

            $result = $this->user_business->getUser();
    
            return $this->respond($result, 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show(int $id)
    {
        try {

            $result = $this->user_business->getUser($id);
    
            return $this->respond($result, 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create()
    {
        try {
            
            $result = $this->user_business->createUser($this->request->getJsonVar('user_name'), $this->request->getJsonVar('email'), $this->request->getJsonVar('password'), $this->request->getJsonVar('sex'));

            return $this->respond($result, 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function edit(int $id)
    {
        try {
            
            $result = $this->user_business->updateUser($id, $this->request->getJsonVar('user_name'), $this->request->getJsonVar('sex'));

            return $this->respond($result, 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(int $id)
    {
        try {

            $result = $this->user_business->deleteUser($id);

            return $this->respond($result, 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
