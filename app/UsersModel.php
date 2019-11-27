<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersModel extends Model
{
    /** 
     * Функция получает данные из таблицы users
     * @return array 
    */
    public static function get_users()
    {
        $departments = DB::table('users')->paginate(4);
        return $departments;
    }

    /** 
     * @param string $ids
     * Функция получает всех пользователей кроме $ids
     * @return array 
    */
    public static function get_all_users(string $ids = null)
    {
        if($ids != null)
        {
            $ids = explode(',', $ids);
            $departments = DB::table('users')->whereNotIn('id', $ids)->get();
            return $departments;
        }
        if($ids == null)
        {
            $departments = DB::table('users')->get();
            return $departments;
        }
    }

    /**
     * @param int $id
     * Функия удаляет пользователя 
     * @return void
    */
    public static function delete_user(int $id)
    {
        DB::table('users')->where('id', $id)->delete();
    }

    /**
     * @param int $id
     * Функия получает данные пользователя
     * @return array
    */
    public static function data_user(int $id)
    {
        $user = DB::table('users')->where('id', $id)->get();
        return $user;
    }

     /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     * Функия редактирует данные пользователя
     * @return void
    */
    public static function change_user(int $id, string $name, string $email, string $password)
    {
        $password = Hash::make($password);
        DB::table('users')->where('id', $id)->update(array('name' => $name, 'email' => $email, 'password' => $password));
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * Функия редактирует данные пользователя
     * @return void
    */
    public static function add_user(string $name, string $email, string $password)
    {
        $password = Hash::make($password);
        DB::table('users')->insert(
            [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'created_at' => now(),
                'password' => $password,
                'remember_token' => Str::random(10),
            ]
        );
    }
}
