<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DepartmentsModel extends Model
{
    /**
     * Фукнция получает данные из таблицы departments и users
     * @return object
    */
    public static function get_departments()
    {
        $departments = DB::table('departments')->paginate(4);
        return $departments;
    }

    /**
     * @param int $id
     * Функия удаляет отдел 
     * @return void
    */
    public static function delete_departments(int $id)
    {
        DB::table('departments')->where('id', $id)->delete();
    }

    /**
     * @param int $id
     * Функия получает отдел
     * @return object
    */
    public static function get_department(int $id)
    {
        $department = DB::table('departments')->where('id', $id)->get();
        return $department;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image
     * @param array $checkbox
     * Функия редактирует данные отдела
     * @return void
    */
    public static function change_department(int $id, string $name, string $description, string $image = null, array $checkbox = null)
    {
        DB::table('departments')->where('id', $id)->update(array('name' => $name, 'description' => $description));
        if($image != null)
        {
            DB::table('departments')->where('id', $id)->update(array('logo' => $image));
        }

        $ids = '';
        if($checkbox != null)
        {
            foreach($checkbox as $item)
            {
                $ids .= ',' . $item;
            }
        }
        $idf = \App\Posts::find($id)->users_id . $ids;
        DB::table('posts')->where('ndepart', $id)->update(['users_id' => $idf]);
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $image
     * @param array $checkbox
     * Функия создает отдел
     * @return void
    */
    public static function add_department(string $name, string $description, string $image, array $checkbox = null)
    {
        DB::table('departments')->insert(
            ['name' => $name, 'description' => $description, 'logo' => $image]
        );

        $ndepart = json_decode(json_encode(DB::table('departments')->where('name', $name)->orWhere('description', $description)->get('id')), true)[0]['id'];
        DB::table('posts')->insert(
            ['id' => $ndepart, 'users_id' => '', 'ndepart' => $ndepart]
        );

        $ids = '';
        if($checkbox != null)
        {
            foreach($checkbox as $item)
            {
                $ids .= ',' . $item;
            }
        }
        DB::table('posts')->where('ndepart', $ndepart)->update(['users_id' => $ids]);
    }

    protected $table = 'departments';
}
