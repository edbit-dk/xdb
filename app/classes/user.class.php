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

    public static function data($user_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[0], '=', $user_id]);
    }

    public static function teams($team)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[5], '=', $team])->results();
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

        var_dump($data);
        die;

        if($data->results()) {
            return $data->first();
        } else {
            return false;
        }

    }

}