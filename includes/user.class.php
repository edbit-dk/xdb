<?php

class User
{
	
	protected static $table = "users";

    protected static $fields = [
       'id',
       'username',
       'password',
       'fullname',
       'type',
       'grade'
    ];

    public static function fields()
    {
        return self::$fields;
    }

    public static function data($user_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[0], '=', $user_id])->first();
    }

    public static function school($grade)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[5], '=', $grade])->results();
    }

    public static function list($type = 'STUDENT')
    {
        global $db;
        return $db->get(self::$table, [self::$fields[4], '=', $type])->results();
    }

    public static function auth($username, $password, $type = 'STUDENT')
    {
        global $db;
        $table = self::$table;
        $user_name = self::$fields[1];
        $pass_word = self::$fields[2];
        $user_type = self::$fields[4];

        if($username && $password) {
            return $db->query("SELECT * FROM {$table} WHERE {$user_name} = ? AND {$pass_word} = ? AND {$user_type} = ?", [$username, $password, $type])->first();
        }

        return false;
    }

}