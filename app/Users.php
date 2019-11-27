<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * Фукнция для выборки из таблицы posts
     * @return object
    */
    public function users()
    {
        return $this->hasOne('App\Users', 'id');
    }
}
