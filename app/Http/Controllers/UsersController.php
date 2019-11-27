<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Функция для отображения страницы users
     * @return Response
    */
    public function index()
    {
        $users = \App\UsersModel::get_users();
        return view('users', [
            'users' => $users,
        ]);
    }

    /**
     * Функция для удаления или генерации страницы редактирования пользователя
     * @return Response
    */
    public function change(Request $request)
    {
        if($request->edit)
        {
            $user = \App\UsersModel::data_user($request->id);
            return view('change_user', [
                'item' => $user[0],
            ]);
        }

        if($request->delete)
        {
            \App\UsersModel::delete_user($request->id);
            return redirect('/users');
        }
    }

    /**
     * Функция для редактирования пользователя
     * @return Redirect
    */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:5',
            'password' => 'required|max:255|min:4',
        ]);

        \App\UsersModel::change_user($request->id, $request->name, $request->email, $request->password);

        return redirect('/users');
    }

    /**
     * Функция для генерации страницы создания пользователя
     * @return Response
    */
    public function add_view()
    {
        return view('add_user');
    }

    /**
     * Функция для создания пользователя
     * @return Redirect
    */
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:5',
            'password' => 'required|max:255|min:4',
        ]);

        \App\UsersModel::add_user($request->name, $request->email, $request->password);

        return redirect('/users');
    }
}
