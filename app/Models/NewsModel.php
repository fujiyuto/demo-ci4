<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model {

    protected $table = 'news';
    protected $allowedFields = ['title', 'slug', 'body'];

    public function getNews(bool|string $slug = false): array|object|null
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }
}
