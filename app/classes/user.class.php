<?php

class User
{
	
	protected static $table = DB_PREFIX . "users";

    protected static $fields = [
       'id',
       'username',
       'password',
       'fullname',
       'admin',
       'team_id'
    ];

    public static function fields()
    {
        return self::$fields;
    }

    public static function data($team_id = 0, $user_id = 0, $is_admin = 0)
    {
        global $db;
        $table = self::$table;
        $id = self::$fields[0];
        $admin = self::$fields[4];
        $team = self::$fields[5];
        
        return $db->query("SELECT * FROM {$table} WHERE {$team} = ? AND ({$id} = ? OR {$admin} = ?)", [$team_id, $user_id, $is_admin]);
    }


    public static function team($team)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[5], '=', $team])->results();
    }

    public static function record($user_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[0], '=', $user_id]);
    }

    public static function admins()
    {
        global $db;
        return $db->get(self::$table, [self::$fields[4], '=', 1])->results();
    }

    public static function list()
    {
        global $db;
        return $db->get(self::$table)->results();
    }

    public static function limit($start, $pages)
    {
        global $db;
        $table = self::$table;
        return $db->query("SELECT * FROM {$table} LIMIT {$start},{$pages}");
    }

    public static function create(array $data)
    {
        global $db;
        return $db->insert(self::$table, $data);
    }

    public static function update(array $data, array $id)
    {
        global $db;
        return $db->update(self::$table, $data, $id);
    }

    public static function auth($username, $password = false, $admin = false)
    {
        global $db;
        $table = self::$table;
        $user_name = self::$fields[1];
        $pass_word = self::$fields[2];
        $user_admin = self::$fields[4];

        $data = $db->query("SELECT * FROM {$table} WHERE {$user_name} = ? AND {$pass_word} = ? AND {$user_admin} = ?", [$username, $password, $admin]);

        if($data->results()) {
            return $data->first();
        } else {
            return false;
        }

    }

}