<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NewsModel;

class News extends Controller {

    public function index(): void
    {
        $model = new NewsModel();
        
        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive'
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer');
    }

    public function view($slug = null): void
    {
        $model = new NewsModel();

        $news_data = $model->getNews($slug);

        if (empty($news_data)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '.$slug);
        }

        $data = [
            'title' => $news_data['title'],
            'news'  => $news_data
        ];

        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer'); 
    }

    public function create(): void
    {
        helper('form');
        $model = new NewsModel();

        if (!$this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ])) {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        } else {
            $insert_data = [
                'title' => $this->request->getVar('title'),
                'slug'  => url_title($this->request->getVar('title')),
                'body'  => $this->request->getVar('body')
            ];
            $model->save($insert_data);
            echo view('news/success');
        }
    }
}