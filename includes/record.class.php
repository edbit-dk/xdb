<?php

class Record
{
	
	protected static $table = "records";

    protected static $fields = [
       'id',
       'user_id',
       'admin_id',
       'subject_id',
       'team_id',
       'final_grade',
       'winter_grade',
       'summer_grade',
       'course_grade'
    ];

    public static function fields()
    {
        return self::$fields;
    }

    public static function list()
    {
        global $db;
        return $db->get(self::$table)->results();
    }

    public static function teams($team_id)
    {
        global $db;
        return $db->get(self::$table, [self::$fields[4], '=', $team_id])->results();
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

    public static function admin($user_id)
    {
        global $db;

        return $db->get(self::$table, [self::$fields[2], '=', $user_id])->results();
       
    }

    public static function user($user_id)
    {
        global $db;
        $table = self::$table;
        $user = self::$fields[1];
        $admin = self::$fields[2];
        
        return $db->query("SELECT * FROM {$table} WHERE {$user} = ? OR {$admin} = ?", [$user_id, $user_id])->results();
       
    }
}