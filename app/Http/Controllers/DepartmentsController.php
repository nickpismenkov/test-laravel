<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Фукнция для отображения страницы "Список отделов"
     * @return Response
     */
    public function index()
    {
        $departments = \App\DepartmentsModel::get_departments();
        $all_departments = \App\DepartmentsModel::all();
        $all_data = array();
        foreach($all_departments as $item)
        {
            $data['users'] = explode(',', \App\Posts::find($item->id)->users_id);
            $data['id'] = \App\Posts::find($item->id)->id;
            for($i = 0; $i < count($data['users']); $i++)
            {
                if(\App\Users::find($data['users'][$i]))
                {
                    $data['users'][$i] = \App\Users::find($data['users'][$i])->name;
                }
                else
                {
                    $data['users'][$i] = null;
                }
            }
            array_push($all_data, $data);
        }
        return view('departments', [
            'departments' => $departments,
            'data' => $all_data,
        ]);
    }

    /**
     * Функция для удаления или генерации страницы редактирования отдела
     * @return Response
    */
    public function change(Request $request)
    {
        if($request->edit)
        {
            $department = \App\DepartmentsModel::get_department($request->id);
            return view('change_department', [
                'item' => $department[0],
                'users' => \App\UsersModel::get_all_users(\App\Posts::find($request->id)->users_id),
            ]);
        }

        if($request->delete)
        {
            \App\DepartmentsModel::delete_departments($request->id);
            return redirect('/');
        }
    }

    /**
     * Функция для редактирования отдела
     * @return Redirect
    */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:5',
            'image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if($request->file('image'))
        {
            $path = $request->file('image')->store('logo');
        }
        else
        {
            $path = null;
        }
        \App\DepartmentsModel::change_department($request->id, $request->name, $request->description, $path, $request->checkbox);

        return redirect('/');
    }

    /**
     * Функция для генерации страницы добавления отдела
     * @return Response
    */
    public function add()
    {
        return view('add_department', [
            'users' => \App\UsersModel::get_all_users(null),
        ]);
    }

    /** 
     * Функция для сохранения нового отдела
     * @return Redirect
    */
    public function add_department(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:5',
            'image' => 'image|mimes:jpeg,jpg,png,gif|required',
        ]);

        $path = $request->file('image')->store('logo');

        \App\DepartmentsModel::add_department($request->name, $request->description, $path, $request->checkbox);

        return redirect('/');
    }
}
