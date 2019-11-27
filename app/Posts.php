<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * Фукнция для выборки из таблицы posts
     * @return object
    */
    public function posts()
    {
        return $this->hasOne('App\Posts');
    }
}
