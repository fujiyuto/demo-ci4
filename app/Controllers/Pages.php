<?php

use CodeIgniter\Controller;

class Pages extends Controller
{
    public function index()
    {
        return view('welcome_message');
    }

    public function showme($page = 'home')
    {
        
    }
}
