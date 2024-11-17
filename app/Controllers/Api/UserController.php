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

    }

    public function edit(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
